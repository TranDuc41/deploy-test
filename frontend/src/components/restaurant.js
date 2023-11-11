import React from 'react';
const restaurantsData = [
  {
    id: 1,
    title: 'DINING',
    name: 'The Mountain View',
    description: 'Contrary to popular belief, Lorem Ipsum is not simply random text.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classicalContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classicalContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. ...',
    moreInfoUrl: '/discover/mountain-view',
    imageUrl: '/restaurant_home.png'
  },
  {
    id: 2,
    title: 'DINING',
    name: 'The Lake House',
    description: 'Savor the fresh flavors by the serene lake.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classicalContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical',
    moreInfoUrl: '/discover/lake-house',
    imageUrl: '/restaurant_home.png'
  },
  {
    id: 3,
    title: 'DINING',
    name: 'The Garden Grille',
    description: 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classicalDine amidst the beauty of nature in our garden setting.',
    moreInfoUrl: '/discover/garden-grille',
    imageUrl: '/restaurant_home.png'
  }
];

const RestaurantInfoModule = ({ restaurant }) => {
  return (
    <div className="col-md-6 col-12 col-xl-4"> 
      <div className="restaurant-module ">
        <div className="image-container">
          <img src={restaurant.imageUrl} alt={`${restaurant.name} view`} className="img-fluid" />
        </div>
        <div className="text-container">
          <h5 className="text-uppercase">{restaurant.title}</h5>
          <h3>{restaurant.name}</h3>
          <p>{restaurant.description}</p>
          <a href={restaurant.moreInfoUrl} className="text-info">Discover more</a>
        </div>
      </div>
    </div>
  );
};

const RestaurantsPage = () => {
  const defaultRestaurantsToShow = restaurantsData.slice(0, 3);
  return (
    <div className="container mt-4">
      <div className="row restaurant-row ">
        {defaultRestaurantsToShow.map(restaurant => (
          <RestaurantInfoModule key={restaurant.id} restaurant={restaurant} />
        ))}
      </div>
    </div>
  );
};
export default RestaurantsPage;
