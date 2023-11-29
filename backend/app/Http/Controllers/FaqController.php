<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FaqController extends Controller
{
    public function index()
    {
        $faqModel = new Faq();
        $faqs = $faqModel->getAllFaq();

        return view('faq', compact('faqs'));
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:200',
                'description' => 'required|max:600',
            ]);
            if ($validator->fails()) {
                return redirect()->route('faq')->with('error', 'Thêm không thành công. Hãy kiểm tra lại dữ liệu nhập.');
            }
            $faqModel = new Faq();

            $faqModel->title = $request->input('title');
            $faqModel->slug = $this->createUniqueSlug($request->input('title')) . '-' . uniqid();
            $faqModel->description = $request->input('description');

            $faqModel->save();

            return redirect()->route('faq')->with('success', 'Thêm thành công.');
        } catch (\Throwable $th) {
            return redirect()->route('faq')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!' . $th->getMessage());
        }
    }

    //Tạo slug
    private function createUniqueSlug($title)
    {
        $slug = Str::slug($title);

        // Kiểm tra xem có bản ghi nào trong cơ sở dữ liệu có slug giống nhau không
        while (DB::table('faq')->where('slug', $slug)->exists()) {
            // Nếu có, thêm một số duy nhất vào slug để tạo slug mới và duy nhất
            $slug = Str::slug($title) . '-' . uniqid();
        }

        return $slug;
    }

    public function show($slug)
    {
        try {
            $faqModel = new Faq();
            $faqs = $faqModel->findFaq($slug);

            if ($faqs) {
                return response()->json($faqs);
            } else {
                return redirect()->route('faq')->with('error', 'Không tìm thấy câu hỏi!.');
            }
        } catch (\Throwable $th) {
            return redirect()->route('faq')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!' . $th->getMessage());
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $faqModel = new Faq();
            $faqs = $faqModel->findFaq($slug);

            if ($faqs) {

                $databaseDateTime = $request->input('time_update');
                $carbonDateTime = Carbon::parse($databaseDateTime);
                $isUpdatedAtMatch = $faqs->isUpdatedAtMatch($carbonDateTime, $faqs->updated_at);

                if ($isUpdatedAtMatch) {
                    $validator = Validator::make($request->all(), [
                        'title' => 'required|max:200',
                        'description' => 'required|max:600',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->route('faq')->with('error', 'Sửa không thành công. Hãy kiểm tra lại dữ liệu nhập.');
                    }

                    $faqs->title = $request->input('title');
                    $faqs->slug = $this->createUniqueSlug($request->input('title')) . '-' . uniqid();
                    $faqs->description = $request->input('description');

                    $faqs->save();

                    return redirect()->route('faq')->with('success', 'Sửa thành công.');
                } else {
                    return redirect()->route('faq')->with('error', 'Đã có dữ liệu mới hơn. Tải lại trang và thử lại!');
                }
            } else {
                return redirect()->route('faq')->with('error', 'Không tìm thấy câu hỏi!.');
            }
        } catch (\Throwable $th) {
            return redirect()->route('faq')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!' . $th->getMessage());
        }
    }

    public function delete($slug)
    {
        try {
            $faqModel = new Faq();
            $faqs = $faqModel->findFaq($slug);

            if ($faqs) {
                $faqs->delete();
                session()->flash('success', 'Xóa thành công.');
                return response()->json(['message' => 'Xóa thành công.']);
            } else {
                return redirect()->route('faq')->with('error', 'Không tìm thấy câu hỏi!.');
            }
        } catch (\Throwable $th) {
            return redirect()->route('faq')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!' . $th->getMessage());
        }
    }
}
