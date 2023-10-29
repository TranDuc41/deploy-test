import React from 'react'; 
import ReactStars from 'react-stars'
  
export default function SkeletonLoading(props){ 
  return ( 
    <div> 
      <ReactStars 
        count={5} 
        value={props.value} 
        edit={false}
        size={30} 
        color2={'#ffd700'} /> 
    </div> 
  ) 
} 