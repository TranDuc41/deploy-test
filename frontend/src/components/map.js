// components/GoogleMap.js

const GoogleMap = () => {
  return (
      <div className="row">
        <div className="col-12">
          <div className="map-content">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4749789211724!2d106.75548381217702!3d10.85143248925734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752797e321f8e9%3A0xb3ff69197b10ec4f!2zVHLGsOG7nW5nIGNhbyDEkeG6s25nIEPDtG5nIG5naOG7hyBUaOG7pyDEkOG7qWM!5e0!3m2!1svi!2s!4v1699121968400!5m2!1svi!2s"
              width="100%"
              height="100%"
              minheight="500px"
              style={{ border: '0' }}
              allowFullScreen=""
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
      </div>
  );
};

export default GoogleMap;
