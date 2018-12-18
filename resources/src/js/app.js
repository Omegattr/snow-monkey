'use strict';

import $ from 'jquery';

import '../../assets/packages/slick-carousel';
import '../../assets/packages/jquery.sticky';
import '../../assets/packages/jquery.background-parallax-scroll';
import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis.js';
import './_wpaw-pickup-slider.js';

import BasisStickyHeader from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis-layout/src/js/sticky-header.js';
import FixAdminBar from './_fix-adminbar.js';
import SnowMonkeyWidgetItemExpander from './_widget-item-expander.js';
import SnowMonkeyHeader from './_header.js';
import SnowMonkeyDropNav from './_drop-nav.js';
import SnowMonkeySmoothScroll from './_smooth-scroll.js';
import SnowMonkeyFooterStickyNav from './_footer-sticky-nav.js';
import SnowMonkeyHashNav from './_hash-nav.js';
import SnowMonkeyActiveMenu from './_active-menu.js';

new BasisStickyHeader();

new FixAdminBar();

new SnowMonkeyWidgetItemExpander();

if (snow_monkey_header_position_only_mobile) {
  new SnowMonkeyHeader();
}

new SnowMonkeyDropNav();

new SnowMonkeySmoothScroll();

new SnowMonkeyFooterStickyNav();

new SnowMonkeyHashNav();

new SnowMonkeyActiveMenu('.p-global-nav', {
  home_url: snow_monkey.home_url,
});

new SnowMonkeyActiveMenu('.p-footer-sticky-nav', {
  home_url: snow_monkey.home_url,
});

$('.l-sidebar-sticky-widget-area').sticky({
  breakpoint: 1024,
  offset  : (() => {
    if ('sticky' === $('.l-header').attr('data-l-header-type')) {
      return $('.l-header').outerHeight() + parseInt($('html').css('margin-top'));
    }
    return $('.l-header__drop-nav .p-global-nav').outerHeight() + parseInt($('html').css('margin-top'));
  })()
});

$('.js-bg-parallax').backgroundParallaxScroll();

$('.wpaw-pickup-slider__canvas').SnowMonkeyWpawPickupSlider();

$(window).on('elementor/frontend/init', () => {
  elementorFrontend.hooks.addAction('frontend/element_ready/widget', (scope) => {
    if (scope.hasClass('elementor-widget-wp-widget-inc2734_wp_awesome_widgets_slider')) {
      scope.find('.wpaw-slider__canvas').WpawSlider();
    } else if (scope.hasClass('elementor-widget-wp-widget-inc2734_wp_awesome_widgets_pickup_slider')) {
      scope.find('.wpaw-pickup-slider__canvas').SnowMonkeyWpawPickupSlider();
    } else if (scope.hasClass('elementor-widget-wp-widget-inc2734_wp_awesome_widgets_showcase')) {
      scope.find('.wpaw-showcase').backgroundParallaxScroll();
    }
  });
});
