import jquery from 'jquery';



import 'owl.carousel';
import VueSweetalert2 from 'vue-sweetalert2';

require('./bootstrap');

window.Vue = require('vue');



Vue.use(VueSweetalert2);

Vue.component('fecha-receta', require('./components/FechaReceta.vue').default);
Vue.component('eliminar-receta',require('./components/EliminarReceta.vue').default);
Vue.component('like-button',require('./components/LikeButton.vue').default);




const app = new Vue({
    el: '#app',
});



$(".heart").on('click touchstart', function(){
    $(this).toggleClass('is_animating');
  });

  /*when the animation is over, remove the class*/
  $(".heart").on('animationend', function(){
    $(this).toggleClass('is_animating');
  });



jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
        margin:10,
        loop:true,
        autoplay:true,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }

        }
    });
})
