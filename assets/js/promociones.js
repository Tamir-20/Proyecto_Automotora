(function($) {

    $(document).ready(function() {

        const slides = $('.slide');

        const dots = $('.dot');

        let currentSlide = 0;

        const totalSlides = slides.length;

        function showSlide(index) {

            slides.removeClass('active');

            dots.removeClass('active');

            slides.eq(index).addClass('active');

            dots.eq(index).addClass('active');

            currentSlide = index;

        }

        dots.each(function(index) {

            $(this).on('click', function() {

                showSlide(index);

            });

        });

        // Auto slide every 20 seconds

        setInterval(function() {

            let nextSlide = (currentSlide + 1) % totalSlides;

            showSlide(nextSlide);

        }, 20000);

    });

})(jQuery);
