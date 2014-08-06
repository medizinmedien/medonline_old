/**!
 * Off-Canvas Navigation
 *
 * Author: David Bushell http://dbushell.com/
 * Article: http://coding.smashingmagazine.com/2013/01/15/off-canvas-navigation-for-responsive-website/
 *
 */
(function(window, document, undefined)
{
    'use strict';

    // browser doesn't support this technique
    if (!document.addEventListener) {
        return false;
    }

    var docEl = document.documentElement;

    // fix Windows Phone 8 viewport bug
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var s = document.createElement('style');
        s.appendChild(document.createTextNode('@-ms-viewport{width:auto!important}'));
        document.getElementsByTagName('head')[0].appendChild(s);
    }

    var LTiOS5;

    // fix iOS < 5 bug
    if(/(iPhone|iPod|iPad)/i.test(navigator.userAgent)) {
        if(/OS [2-4]_\d(_\d)? like Mac OS X/i.test(navigator.userAgent)) { // iOS 2-4
            docEl.className += ' no-ios5 ';
            LTiOS5 = true;
        } else if(/CPU like Mac OS X/i.test(navigator.userAgent)) { // iOS 1
            docEl.className += ' no-ios5 ';
            LTiOS5 = true;
        } else {
        }
    }

    var $ = window.jQuery;

    // window.Modernizr.csstransforms3d = false;
    // $(docEl).removeClass('csstransforms3d').addClass('no-csstransforms3d');

        // is the off-canvas navigation visible?
    var nav_open = false,

        // `id` attribute of main navigation element
        nav_id = 'nav',

        // class to append to <html> document element when nav is open
        nav_class = 'js-nav',

        // element to transition
        nav_inner = document.getElementById('inner-wrap');



    var transform_prop = window.Modernizr.prefixed('transform'),
        transition_prop = window.Modernizr.prefixed('transition'),
        transition_end = (function() {
            var props = {
                'WebkitTransition' : 'webkitTransitionEnd',
                'MozTransition'    : 'transitionend',
                'OTransition'      : 'oTransitionEnd otransitionend',
                'msTransition'     : 'MSTransitionEnd',
                'transition'       : 'transitionend'
            };
            return props.hasOwnProperty(transition_prop) ? props[transition_prop] : false;
        })();

    var closeNavEnd = function(e)
    {
        if (e && e.target === nav_inner) {
            document.removeEventListener(transition_end, closeNavEnd, false);
        }
        nav_open = false;
    };

    var closeNav =function()
    {
        if (nav_open) {
            // close navigation after transition or immediately
            var duration = (transition_end && transition_prop) ? parseFloat(window.getComputedStyle(nav_inner, '')[transition_prop + 'Duration']) : 0;
            if (LTiOS5 !== true && duration > 0) {
                document.addEventListener(transition_end, closeNavEnd, false);
            } else {
                closeNavEnd(null);
            }
        }
        $(docEl).removeClass(nav_class);
	  jQuery('nav').css('display','none');
    };

    var openNav = function()
    {
        if (nav_open) {
            return;
        }
        $(docEl).addClass(nav_class);
        nav_open = true;
	  jQuery('nav').css('display','inherit');
    };

    var toggleNav = function(e)
    {
        if (nav_open && $(docEl).hasClass(nav_class)) {
            closeNav();
        } else {
            openNav();
        }
        if (e) {
            e.preventDefault();
        }
    };

    $(document).ready(function()
    {
        $('#site-nav-open').on('click', toggleNav);
        $('#site-nav-close').on('click', toggleNav);

        document.addEventListener('click', function(e)
        {
            if (nav_open && !$(e.target).closest('#' + nav_id).length) {
                e.preventDefault();
                closeNav();
            }
        },
        true);

        var nav = $('#' + nav_id);
        // collapse first level of sub-menus
        nav.find('.menu > li > .sub-menu').slideUp(0).addClass('is-collapsed');

        nav.on('click', '.menu > li > .sub-menu', function(e)
        {
            var target = $(e.target);
            if (target.hasClass('is-collapsed')) {
                target.removeClass('is-collapsed').slideDown(200, function() {
                    target.addClass('is-expanded');
                });
                return false;
            } else if ($(e.target).hasClass('is-expanded')) {
                target.removeClass('is-expanded').slideUp(200, function() {
                    target.addClass('is-collapsed');
                });
                return false;
            }
        });

        if (window.location.hash && window.location.hash === ('#' + nav_id)) {
            setTimeout(function() {
                window.scrollTo(0);
                setTimeout(function() { toggleNav(); }, 1);
            }, 1);
        }
    });

})(window, window.document);
