import '@fancyapps/fancybox';
import '@fancyapps/fancybox/dist/jquery.fancybox.min.css';

import './scss/styles.scss';
import './js/commons';
import Prism from 'prismjs';

(function ($) {
    $(document).ready(function () {

        $('.service-box__title--js').each(function () {
            var strResult = '';
            var str = $(this).text();
            var strArray = (str.split(" "));
            var initialWord = '';

            strArray.forEach(function (strWord, i, strArray) {
                if (!(strWord.trim() == '')) {

                    strWord = initialWord + strWord;
                    if (strWord.length > 3) {
                        initialWord = '';
                        strResult = strResult + '<span>' + strWord + '</span><br>';
                    } else {
                        initialWord = strWord + ' ';
                    }
                }
            });
            $(this).html(strResult);
        });

        $('.developments-list-item').mouseenter(function(){
            $('#developments-list__clipper-hover')[0].beginElement();
        });
        $('.developments-list-item').mouseleave(function(){
            $('#developments-list__clipper-unhover')[0].beginElement();
        });

        $('.service-box').each(function() {
            $(this).mouseenter(function(){
                $('.clipper-hover', this)[0].beginElement();
            });
            $(this).mouseleave(function(){
                $('.clipper-unhover', this)[0].beginElement();
            });
        });
    });

    $(window).on('load', function(){

    });

    $(window).on('resize', function(){

    });

})(jQuery);