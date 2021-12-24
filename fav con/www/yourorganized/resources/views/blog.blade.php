@extends('layouts.app')
@push('styles')
<title>Blog</title>
<link rel='dns-prefetch' href='//fonts.googleapis.com' />
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="Coaching Website &raquo; Feed" href="https://viarchtechnologies.com/projects/coachthem/blog/feed/" />
<link rel="alternate" type="application/rss+xml" title="Coaching Website &raquo; Comments Feed" href="https://viarchtechnologies.com/projects/coachthem/blog/comments/feed/" />
		<script>
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/viarchtechnologies.com\/projects\/coachthem\/blog\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.5.3"}};
			!function(e,a,t){var r,n,o,i,p=a.createElement("canvas"),s=p.getContext&&p.getContext("2d");function c(e,t){var a=String.fromCharCode;s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,e),0,0);var r=p.toDataURL();return s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,t),0,0),r===p.toDataURL()}function l(e){if(!s||!s.fillText)return!1;switch(s.textBaseline="top",s.font="600 32px Arial",e){case"flag":return!c([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])&&(!c([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!c([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]));case"emoji":return!c([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}function d(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(i=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},o=0;o<i.length;o++)t.supports[i[o]]=l(i[o]),t.supports.everything=t.supports.everything&&t.supports[i[o]],"flag"!==i[o]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[i[o]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(r=t.source||{}).concatemoji?d(r.concatemoji):r.wpemoji&&r.twemoji&&(d(r.twemoji),d(r.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style>
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
	<link rel='stylesheet' id='astra-theme-css-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/themes/astra/assets/css/minified/style.min.css?ver=2.6.0' media='all' />
<style id='astra-theme-css-inline-css'>
html{font-size:100%;}a,.page-title{color:#001b61;}a:hover,a:focus{color:#0d3c00;}body,button,input,select,textarea,.ast-button,.ast-custom-button{font-family:'Poppins',sans-serif;font-weight:400;font-size:16px;font-size:1rem;}blockquote{color:#0f0f0f;}p,.entry-content p{margin-bottom:1em;}h1,.entry-content h1,h2,.entry-content h2,h3,.entry-content h3,h4,.entry-content h4,h5,.entry-content h5,h6,.entry-content h6,.site-title,.site-title a{font-family:'Poppins',sans-serif;font-weight:600;text-transform:capitalize;}.site-title{font-size:20px;font-size:1.25rem;}header .site-logo-img .custom-logo-link img{max-width:105px;}.astra-logo-svg{width:105px;}.ast-archive-description .ast-archive-title{font-size:40px;font-size:2.5rem;}.site-header .site-description{font-size:11px;font-size:0.6875rem;}.entry-title{font-size:30px;font-size:1.875rem;}.comment-reply-title{font-size:26px;font-size:1.625rem;}.ast-comment-list #cancel-comment-reply-link{font-size:16px;font-size:1rem;}h1,.entry-content h1{font-size:64px;font-size:4rem;font-family:'Poppins',sans-serif;line-height:1.1;text-transform:capitalize;}h2,.entry-content h2{font-size:40px;font-size:2.5rem;font-family:'Poppins',sans-serif;line-height:1.1;text-transform:capitalize;}h3,.entry-content h3{font-size:32px;font-size:2rem;font-family:'Poppins',sans-serif;line-height:1.1;text-transform:capitalize;}h4,.entry-content h4{font-size:22px;font-size:1.375rem;line-height:1.1;}h5,.entry-content h5{font-size:18px;font-size:1.125rem;line-height:1.1;}h6,.entry-content h6{font-size:14px;font-size:0.875rem;line-height:1.1;}.ast-single-post .entry-title,.page-title{font-size:30px;font-size:1.875rem;}#secondary,#secondary button,#secondary input,#secondary select,#secondary textarea{font-size:16px;font-size:1rem;}::selection{background-color:#40bf4f;color:#000000;}body,h1,.entry-title a,.entry-content h1,h2,.entry-content h2,h3,.entry-content h3,h4,.entry-content h4,h5,.entry-content h5,h6,.entry-content h6,.wc-block-grid__product-title{color:#5a5a5a;}.tagcloud a:hover,.tagcloud a:focus,.tagcloud a.current-item{color:#ffffff;border-color:#001b61;background-color:#001b61;}.main-header-menu .menu-link,.ast-header-custom-item a{color:#5a5a5a;}.main-header-menu .menu-item:hover > .menu-link,.main-header-menu .menu-item:hover > .ast-menu-toggle,.main-header-menu .ast-masthead-custom-menu-items a:hover,.main-header-menu .menu-item.focus > .menu-link,.main-header-menu .menu-item.focus > .ast-menu-toggle,.main-header-menu .current-menu-item > .menu-link,.main-header-menu .current-menu-ancestor > .menu-link,.main-header-menu .current-menu-item > .ast-menu-toggle,.main-header-menu .current-menu-ancestor > .ast-menu-toggle{color:#001b61;}input:focus,input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="reset"]:focus,input[type="search"]:focus,textarea:focus{border-color:#001b61;}input[type="radio"]:checked,input[type=reset],input[type="checkbox"]:checked,input[type="checkbox"]:hover:checked,input[type="checkbox"]:focus:checked,input[type=range]::-webkit-slider-thumb{border-color:#001b61;background-color:#001b61;box-shadow:none;}.site-footer a:hover + .post-count,.site-footer a:focus + .post-count{background:#001b61;border-color:#001b61;}.ast-small-footer{color:rgba(255,255,255,0.75);}.ast-small-footer > .ast-footer-overlay{background-color:#000000;;}.ast-small-footer a{color:rgba(255,255,255,0.75);}.ast-small-footer a:hover{color:#ffffff;}.footer-adv .footer-adv-overlay{border-top-style:solid;border-top-color:#7a7a7a;}.ast-comment-meta{line-height:1.666666667;font-size:13px;font-size:0.8125rem;}.single .nav-links .nav-previous,.single .nav-links .nav-next,.single .ast-author-details .author-title,.ast-comment-meta{color:#001b61;}.entry-meta,.entry-meta *{line-height:1.45;color:#001b61;}.entry-meta a:hover,.entry-meta a:hover *,.entry-meta a:focus,.entry-meta a:focus *{color:#0d3c00;}.ast-404-layout-1 .ast-404-text{font-size:200px;font-size:12.5rem;}.widget-title{font-size:22px;font-size:1.375rem;color:#5a5a5a;}#cat option,.secondary .calendar_wrap thead a,.secondary .calendar_wrap thead a:visited{color:#001b61;}.secondary .calendar_wrap #today,.ast-progress-val span{background:#001b61;}.secondary a:hover + .post-count,.secondary a:focus + .post-count{background:#001b61;border-color:#001b61;}.calendar_wrap #today > a{color:#ffffff;}.ast-pagination a,.page-links .page-link,.single .post-navigation a{color:#001b61;}.ast-pagination a:hover,.ast-pagination a:focus,.ast-pagination > span:hover:not(.dots),.ast-pagination > span.current,.page-links > .page-link,.page-links .page-link:hover,.post-navigation a:hover{color:#0d3c00;}.ast-header-break-point .ast-mobile-menu-buttons-minimal.menu-toggle{background:transparent;color:#40bf4f;}.ast-header-break-point .ast-mobile-menu-buttons-outline.menu-toggle{background:transparent;border:1px solid #40bf4f;color:#40bf4f;}.ast-header-break-point .ast-mobile-menu-buttons-fill.menu-toggle{background:#40bf4f;color:#000000;}.ast-header-break-point .main-header-bar .ast-button-wrap .menu-toggle{border-radius:100px;}@media (max-width:782px){.entry-content .wp-block-columns .wp-block-column{margin-left:0px;}}@media (max-width:921px){#secondary.secondary{padding-top:0;}.ast-separate-container .ast-article-post,.ast-separate-container .ast-article-single{padding:1.5em 2.14em;}.ast-separate-container #primary,.ast-separate-container #secondary{padding:1.5em 0;}.ast-separate-container.ast-right-sidebar #secondary{padding-left:1em;padding-right:1em;}.ast-separate-container.ast-two-container #secondary{padding-left:0;padding-right:0;}.ast-page-builder-template .entry-header #secondary{margin-top:1.5em;}.ast-page-builder-template #secondary{margin-top:1.5em;}#primary,#secondary{padding:1.5em 0;margin:0;}.ast-left-sidebar #content > .ast-container{display:flex;flex-direction:column-reverse;width:100%;}.ast-author-box img.avatar{margin:20px 0 0 0;}.ast-pagination{padding-top:1.5em;text-align:center;}.ast-pagination .next.page-numbers{display:inherit;float:none;}}@media (max-width:921px){.ast-page-builder-template.ast-left-sidebar #secondary{padding-right:20px;}.ast-page-builder-template.ast-right-sidebar #secondary{padding-left:20px;}.ast-right-sidebar #primary{padding-right:0;}.ast-right-sidebar #secondary{padding-left:0;}.ast-left-sidebar #primary{padding-left:0;}.ast-left-sidebar #secondary{padding-right:0;}.ast-pagination .prev.page-numbers{padding-left:.5em;}.ast-pagination .next.page-numbers{padding-right:.5em;}}@media (min-width:922px){.ast-separate-container.ast-right-sidebar #primary,.ast-separate-container.ast-left-sidebar #primary{border:0;}.ast-separate-container.ast-right-sidebar #secondary,.ast-separate-container.ast-left-sidebar #secondary{border:0;margin-left:auto;margin-right:auto;}.ast-separate-container.ast-two-container #secondary .widget:last-child{margin-bottom:0;}.ast-separate-container .ast-comment-list li .comment-respond{padding-left:2.66666em;padding-right:2.66666em;}.ast-author-box{-js-display:flex;display:flex;}.ast-author-bio{flex:1;}.error404.ast-separate-container #primary,.search-no-results.ast-separate-container #primary{margin-bottom:4em;}}@media (min-width:922px){.ast-right-sidebar #primary{border-right:1px solid #eee;}.ast-right-sidebar #secondary{border-left:1px solid #eee;margin-left:-1px;}.ast-left-sidebar #primary{border-left:1px solid #eee;}.ast-left-sidebar #secondary{border-right:1px solid #eee;margin-right:-1px;}.ast-separate-container.ast-two-container.ast-right-sidebar #secondary{padding-left:30px;padding-right:0;}.ast-separate-container.ast-two-container.ast-left-sidebar #secondary{padding-right:30px;padding-left:0;}}.elementor-button-wrapper .elementor-button{border-style:solid;border-top-width:0;border-right-width:0;border-left-width:0;border-bottom-width:0;}body .elementor-button.elementor-size-sm,body .elementor-button.elementor-size-xs,body .elementor-button.elementor-size-md,body .elementor-button.elementor-size-lg,body .elementor-button.elementor-size-xl,body .elementor-button{border-radius:50px;padding-top:17px;padding-right:26px;padding-bottom:17px;padding-left:26px;}.elementor-button-wrapper .elementor-button{border-color:#dd5329;background-color:#dd5329;}.elementor-button-wrapper .elementor-button:hover,.elementor-button-wrapper .elementor-button:focus{color:#ffffff;background-color:#001b61;border-color:#001b61;}.wp-block-button .wp-block-button__link,.elementor-button-wrapper .elementor-button,.elementor-button-wrapper .elementor-button:visited{color:#ffffff;}.elementor-button-wrapper .elementor-button{font-family:'Poppins',sans-serif;font-weight:500;line-height:1;text-transform:capitalize;letter-spacing:0.5px;}body .elementor-button.elementor-size-sm,body .elementor-button.elementor-size-xs,body .elementor-button.elementor-size-md,body .elementor-button.elementor-size-lg,body .elementor-button.elementor-size-xl,body .elementor-button{font-size:14px;font-size:0.875rem;}.wp-block-button .wp-block-button__link{border-style:solid;border-top-width:0;border-right-width:0;border-left-width:0;border-bottom-width:0;border-color:#dd5329;background-color:#dd5329;color:#ffffff;font-family:'Poppins',sans-serif;font-weight:500;line-height:1;text-transform:capitalize;letter-spacing:0.5px;font-size:14px;font-size:0.875rem;border-radius:50px;padding-top:17px;padding-right:26px;padding-bottom:17px;padding-left:26px;}.wp-block-button .wp-block-button__link:hover,.wp-block-button .wp-block-button__link:focus{color:#ffffff;background-color:#001b61;border-color:#001b61;}.elementor-widget-heading h1.elementor-heading-title{line-height:1.1;}.elementor-widget-heading h2.elementor-heading-title{line-height:1.1;}.elementor-widget-heading h3.elementor-heading-title{line-height:1.1;}.elementor-widget-heading h4.elementor-heading-title{line-height:1.1;}.elementor-widget-heading h5.elementor-heading-title{line-height:1.1;}.elementor-widget-heading h6.elementor-heading-title{line-height:1.1;}.menu-toggle,button,.ast-button,.ast-custom-button,.button,input#submit,input[type="button"],input[type="submit"],input[type="reset"]{border-style:solid;border-top-width:0;border-right-width:0;border-left-width:0;border-bottom-width:0;color:#ffffff;border-color:#dd5329;background-color:#dd5329;border-radius:50px;padding-top:17px;padding-right:26px;padding-bottom:17px;padding-left:26px;font-family:'Poppins',sans-serif;font-weight:500;font-size:14px;font-size:0.875rem;line-height:1;text-transform:capitalize;letter-spacing:0.5px;}button:focus,.menu-toggle:hover,button:hover,.ast-button:hover,.button:hover,input[type=reset]:hover,input[type=reset]:focus,input#submit:hover,input#submit:focus,input[type="button"]:hover,input[type="button"]:focus,input[type="submit"]:hover,input[type="submit"]:focus{color:#ffffff;background-color:#001b61;border-color:#001b61;}@media (min-width:921px){.ast-container{max-width:100%;}}@media (min-width:544px){.ast-container{max-width:100%;}}@media (max-width:544px){.ast-separate-container .ast-article-post,.ast-separate-container .ast-article-single{padding:1.5em 1em;}.ast-separate-container #content .ast-container{padding-left:0.54em;padding-right:0.54em;}.ast-separate-container #secondary{padding-top:0;}.ast-separate-container.ast-two-container #secondary .widget{margin-bottom:1.5em;padding-left:1em;padding-right:1em;}.ast-separate-container .comments-count-wrapper{padding:1.5em 1em;}.ast-separate-container .ast-comment-list li.depth-1{padding:1.5em 1em;margin-bottom:1.5em;}.ast-separate-container .ast-comment-list .bypostauthor{padding:.5em;}.ast-separate-container .ast-archive-description{padding:1.5em 1em;}.ast-search-menu-icon.ast-dropdown-active .search-field{width:170px;}.ast-separate-container .comment-respond{padding:1.5em 1em;}}@media (max-width:544px){.ast-comment-list .children{margin-left:0.66666em;}.ast-separate-container .ast-comment-list .bypostauthor li{padding:0 0 0 .5em;}}@media (max-width:921px){.ast-mobile-header-stack .main-header-bar .ast-search-menu-icon{display:inline-block;}.ast-header-break-point.ast-header-custom-item-outside .ast-mobile-header-stack .main-header-bar .ast-search-icon{margin:0;}.ast-comment-avatar-wrap img{max-width:2.5em;}.comments-area{margin-top:1.5em;}.ast-separate-container .comments-count-wrapper{padding:2em 2.14em;}.ast-separate-container .ast-comment-list li.depth-1{padding:1.5em 2.14em;}.ast-separate-container .comment-respond{padding:2em 2.14em;}}@media (max-width:921px){.ast-header-break-point .main-header-bar .ast-search-menu-icon.slide-search .search-form{right:0;}.ast-header-break-point .ast-mobile-header-stack .main-header-bar .ast-search-menu-icon.slide-search .search-form{right:-1em;}.ast-comment-avatar-wrap{margin-right:0.5em;}}@media (min-width:922px){.ast-small-footer .ast-container{max-width:100%;padding-left:35px;padding-right:35px;}}@media (min-width:545px){.ast-page-builder-template .comments-area,.single.ast-page-builder-template .entry-header,.single.ast-page-builder-template .post-navigation{max-width:1240px;margin-left:auto;margin-right:auto;}}@media (max-width:921px){.site-title{font-size:18px;font-size:1.125rem;}.ast-archive-description .ast-archive-title{font-size:40px;}.site-header .site-description{font-size:12px;font-size:0.75rem;}.entry-title{font-size:30px;}h1,.entry-content h1{font-size:48px;}h2,.entry-content h2{font-size:32px;}h3,.entry-content h3{font-size:24px;}h4,.entry-content h4{font-size:20px;font-size:1.25rem;}h5,.entry-content h5{font-size:16px;font-size:1rem;}h6,.entry-content h6{font-size:13px;font-size:0.8125rem;}.ast-single-post .entry-title,.page-title{font-size:30px;}#masthead .site-logo-img .custom-logo-link img{max-width:40px;}.astra-logo-svg{width:40px;}.ast-header-break-point .site-logo-img .custom-mobile-logo-link img{max-width:40px;}}@media (max-width:544px){.site-title{font-size:16px;font-size:1rem;}.ast-archive-description .ast-archive-title{font-size:40px;}.site-header .site-description{font-size:11px;font-size:0.6875rem;}.entry-title{font-size:30px;}h1,.entry-content h1{font-size:40px;}h2,.entry-content h2{font-size:28px;}h3,.entry-content h3{font-size:24px;}h4,.entry-content h4{font-size:20px;font-size:1.25rem;}h5,.entry-content h5{font-size:16px;font-size:1rem;}h6,.entry-content h6{font-size:13px;font-size:0.8125rem;}.ast-single-post .entry-title,.page-title{font-size:30px;}.ast-header-break-point .site-branding img,.ast-header-break-point #masthead .site-logo-img .custom-logo-link img{max-width:32px;}.astra-logo-svg{width:32px;}.ast-header-break-point .site-logo-img .custom-mobile-logo-link img{max-width:32px;}}@media (max-width:921px){html{font-size:91.2%;}}@media (max-width:544px){html{font-size:91.2%;}}@media (min-width:922px){.ast-container{max-width:1240px;}}@font-face {font-family: "Astra";src: url(https://viarchtechnologies.com/projects/coachthem/blog/wp-content/themes/astra/assets/fonts/astra.woff) format("woff"),url(https://viarchtechnologies.com/projects/coachthem/blog/wp-content/themes/astra/assets/fonts/astra.ttf) format("truetype"),url(https://viarchtechnologies.com/projects/coachthem/blog/wp-content/themes/astra/assets/fonts/astra.svg#astra) format("svg");font-weight: normal;font-style: normal;font-display: fallback;}@media (max-width:921px) {.main-header-bar .main-header-bar-navigation{display:none;}}.ast-desktop .main-header-menu.submenu-with-border .sub-menu,.ast-desktop .main-header-menu.submenu-with-border .astra-full-megamenu-wrapper{border-color:#eaeaea;}.ast-desktop .main-header-menu.submenu-with-border .sub-menu{border-top-width:0px;border-right-width:0px;border-left-width:0px;border-bottom-width:0px;border-style:solid;}.ast-desktop .main-header-menu.submenu-with-border .sub-menu .sub-menu{top:-0px;}.ast-desktop .main-header-menu.submenu-with-border .sub-menu .menu-link,.ast-desktop .main-header-menu.submenu-with-border .children .menu-link{border-bottom-width:0px;border-style:solid;border-color:#eaeaea;}@media (min-width:922px){.main-header-menu .sub-menu .menu-item.ast-left-align-sub-menu:hover > .sub-menu,.main-header-menu .sub-menu .menu-item.ast-left-align-sub-menu.focus > .sub-menu{margin-left:-0px;}}.ast-small-footer{border-top-style:solid;border-top-width:1px;border-top-color:#333333;}.ast-small-footer-wrap{text-align:center;}@media (max-width:920px){.ast-404-layout-1 .ast-404-text{font-size:100px;font-size:6.25rem;}}@media (min-width:922px){.ast-theme-transparent-header #masthead{position:absolute;left:0;right:0;}.ast-theme-transparent-header .main-header-bar,.ast-theme-transparent-header.ast-header-break-point .main-header-bar{background:none;}body.elementor-editor-active.ast-theme-transparent-header #masthead,.fl-builder-edit .ast-theme-transparent-header #masthead,body.vc_editor.ast-theme-transparent-header #masthead,body.brz-ed.ast-theme-transparent-header #masthead{z-index:0;}.ast-header-break-point.ast-replace-site-logo-transparent.ast-theme-transparent-header .custom-mobile-logo-link{display:none;}.ast-header-break-point.ast-replace-site-logo-transparent.ast-theme-transparent-header .transparent-custom-logo{display:inline-block;}.ast-theme-transparent-header .ast-above-header{background-image:none;background-color:transparent;}.ast-theme-transparent-header .ast-below-header{background-image:none;background-color:transparent;}}.ast-theme-transparent-header .site-title a,.ast-theme-transparent-header .site-title a:focus,.ast-theme-transparent-header .site-title a:hover,.ast-theme-transparent-header .site-title a:visited{color:#1a1a1a;}.ast-theme-transparent-header .site-header .site-description{color:#1a1a1a;}@media (max-width:921px){.ast-theme-transparent-header #masthead{position:absolute;left:0;right:0;}.ast-theme-transparent-header .main-header-bar,.ast-theme-transparent-header.ast-header-break-point .main-header-bar{background:none;}body.elementor-editor-active.ast-theme-transparent-header #masthead,.fl-builder-edit .ast-theme-transparent-header #masthead,body.vc_editor.ast-theme-transparent-header #masthead,body.brz-ed.ast-theme-transparent-header #masthead{z-index:0;}.ast-header-break-point.ast-replace-site-logo-transparent.ast-theme-transparent-header .custom-mobile-logo-link{display:none;}.ast-header-break-point.ast-replace-site-logo-transparent.ast-theme-transparent-header .transparent-custom-logo{display:inline-block;}.ast-theme-transparent-header .ast-above-header{background-image:none;background-color:transparent;}.ast-theme-transparent-header .ast-below-header{background-image:none;background-color:transparent;}}.ast-theme-transparent-header .main-header-bar,.ast-theme-transparent-header.ast-header-break-point .main-header-bar{border-bottom-width:0;border-bottom-style:solid;}.ast-breadcrumbs .trail-browse,.ast-breadcrumbs .trail-items,.ast-breadcrumbs .trail-items li{display:inline-block;margin:0;padding:0;border:none;background:inherit;text-indent:0;}.ast-breadcrumbs .trail-browse{font-size:inherit;font-style:inherit;font-weight:inherit;color:inherit;}.ast-breadcrumbs .trail-items{list-style:none;}.trail-items li::after{padding:0 0.3em;content:"\00bb";}.trail-items li:last-of-type::after{display:none;}h1,.entry-content h1,h2,.entry-content h2,h3,.entry-content h3,h4,.entry-content h4,h5,.entry-content h5,h6,.entry-content h6{color:#0d3c00;}.elementor-widget-heading .elementor-heading-title{margin:0;}.ast-header-break-point .main-header-bar{border-bottom-width:0;}@media (min-width:922px){.main-header-bar{border-bottom-width:0;}}.ast-flex{-webkit-align-content:center;-ms-flex-line-pack:center;align-content:center;-webkit-box-align:center;-webkit-align-items:center;-moz-box-align:center;-ms-flex-align:center;align-items:center;}.main-header-bar{padding:1em 0;}.ast-site-identity{padding:0;}.header-main-layout-1 .ast-flex.main-header-container, .header-main-layout-3 .ast-flex.main-header-container{-webkit-align-content:center;-ms-flex-line-pack:center;align-content:center;-webkit-box-align:center;-webkit-align-items:center;-moz-box-align:center;-ms-flex-align:center;align-items:center;}.header-main-layout-1 .ast-flex.main-header-container, .header-main-layout-3 .ast-flex.main-header-container{-webkit-align-content:center;-ms-flex-line-pack:center;align-content:center;-webkit-box-align:center;-webkit-align-items:center;-moz-box-align:center;-ms-flex-align:center;align-items:center;}
</style>
<link rel='stylesheet' id='astra-google-fonts-css'  href='//fonts.googleapis.com/css?family=Poppins%3A400%2C%2C600%2C500&#038;display=fallback&#038;ver=2.6.0' media='all' />
<link rel='stylesheet' id='wp-block-library-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-includes/css/dist/block-library/style.min.css?ver=5.5.3' media='all' />
<link rel='stylesheet' id='hfe-style-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/header-footer-elementor/assets/css/header-footer-elementor.css?ver=1.5.3' media='all' />
<link rel='stylesheet' id='elementor-icons-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.9.1' media='all' />
<link rel='stylesheet' id='elementor-animations-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/lib/animations/animations.min.css?ver=3.0.13' media='all' />
<link rel='stylesheet' id='elementor-frontend-legacy-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/css/frontend-legacy.min.css?ver=3.0.13' media='all' />
<link rel='stylesheet' id='elementor-frontend-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.0.13' media='all' />
<link rel='stylesheet' id='elementor-post-320-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/elementor/css/post-320.css?ver=1605031770' media='all' />
<link rel='stylesheet' id='post-grid-elementor-addon-main-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/post-grid-elementor-addon/assets/css/main.css?ver=5.5.3' media='all' />
<link rel='stylesheet' id='font-awesome-5-all-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/lib/font-awesome/css/all.min.css?ver=3.0.13' media='all' />
<link rel='stylesheet' id='font-awesome-4-shim-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/lib/font-awesome/css/v4-shims.min.css?ver=3.0.13' media='all' />
<link rel='stylesheet' id='elementor-post-621-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/elementor/css/post-621.css?ver=1605033846' media='all' />
<link rel='stylesheet' id='hfe-widgets-style-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/header-footer-elementor/inc/widgets-css/frontend.css?ver=1.5.3' media='all' />
<link rel='stylesheet' id='elementor-post-234-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/elementor/css/post-234.css?ver=1605033701' media='all' />
<link rel='stylesheet' id='google-fonts-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=5.5.3' media='all' />
<link rel='stylesheet' id='elementor-icons-shared-0-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.12.0' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-brands-css'  href='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css?ver=5.12.0' media='all' />
<!--[if IE]>
<script src='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/themes/astra/assets/js/minified/flexibility.min.js?ver=2.6.0' id='astra-flexibility-js'></script>
<script id='astra-flexibility-js-after'>
flexibility(document.documentElement);
</script>
<![endif]-->
<script src='https://viarchtechnologies.com/projects/coachthem/blog/wp-content/plugins/elementor/assets/lib/font-awesome/js/v4-shims.min.js?ver=3.0.13' id='font-awesome-4-shim-js'></script>
<link rel="https://api.w.org/" href="https://viarchtechnologies.com/projects/coachthem/blog/wp-json/" /><link rel="alternate" type="application/json" href="https://viarchtechnologies.com/projects/coachthem/blog/wp-json/wp/v2/pages/621" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://viarchtechnologies.com/projects/coachthem/blog/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://viarchtechnologies.com/projects/coachthem/blog/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 5.5.3" />
<link rel="canonical" href="https://viarchtechnologies.com/projects/coachthem/blog/" />
<link rel='shortlink' href='https://viarchtechnologies.com/projects/coachthem/blog/' />
<link rel="alternate" type="application/json+oembed" href="https://viarchtechnologies.com/projects/coachthem/blog/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fviarchtechnologies.com%2Fprojects%2Fcoachthem%2Fblog%2F" />
<link rel="alternate" type="text/xml+oembed" href="https://viarchtechnologies.com/projects/coachthem/blog/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fviarchtechnologies.com%2Fprojects%2Fcoachthem%2Fblog%2F&#038;format=xml" />
<style>.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>		<style id="wp-custom-css">
			.elementor-widget-elementor-blog-posts .wpcap-grid .wpcap-grid-container .wpcap-post .title, .elementor-widget-elementor-blog-posts .wpcap-grid .wpcap-grid-container .wpcap-post .title > a {
    color: #ffc90e;
    margin: 5px 0;
    padding: 5px 0;
}		</style>
@endpush
@section('content')
<div id="content" class="site-content">

		<div class="ast-container">

		

	<div id="primary" class="content-area primary">

		
					<main id="main" class="site-main">

				
					
					

<article 
	class="post-621 page type-page status-publish ast-article-single" id="post-621" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">

	
	<header class="entry-header ast-header-without-markup">

		
			</header><!-- .entry-header -->

	<div class="entry-content clear" 
		itemprop="text"	>

		
				<div data-elementor-type="wp-page" data-elementor-id="621" class="elementor elementor-621" data-elementor-settings="[]">
						<div class="elementor-inner">
							<div class="elementor-section-wrap">
							<section class="elementor-section elementor-top-section elementor-element elementor-element-b500500 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="b500500" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b4e0365" data-id="b4e0365" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-24f742e elementor-widget elementor-widget-heading" data-id="24f742e" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h1 class="elementor-heading-title elementor-size-default">Cochthem Blog</h1>		</div>
				</div>
						</div>
					</div>
		</div>
								</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-7d86d73 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7d86d73" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-52f8922" data-id="52f8922" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-478ffcd elementor-grid-3 elementor-grid-tablet-2 elementor-grid-mobile-1 elementor-widget elementor-widget-elementor-blog-posts" data-id="478ffcd" data-element_type="widget" data-settings="{&quot;columns&quot;:&quot;3&quot;,&quot;columns_tablet&quot;:&quot;2&quot;,&quot;columns_mobile&quot;:&quot;1&quot;}" data-widget_type="elementor-blog-posts.default">
				<div class="elementor-widget-container">
					<div class="wpcap-grid">
						<div class="wpcap-grid-container elementor-grid wpcap-grid-desktop-3 wpcap-grid-tablet-2 wpcap-grid-mobile-1">

				
        <article id="post-654" class="wpcap-post post-654 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized ast-article-single">
         
            <div class="post-grid-inner">
            	
            				<div class="post-grid-thumbnail">
				<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title-3/">
					<img width="390" height="274" src="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-02.jpg" class="attachment-full size-full wp-post-image" alt="" loading="lazy" srcset="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-02.jpg 390w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-02-300x211.jpg 300w" sizes="(max-width: 390px) 100vw, 390px" />				</a>
			</div>
        
                <div class="post-grid-text-wrap">
               				<h2 class="title">
			<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title-3/">page builder Title</a>
		</h2>
			                	                		<div class="post-grid-excerpt">
			<p>Elementor page builder addon to display posts in a grid. Useful for generating post grid from&hellip;</p>
		</div>
			                		<a class="read-more-btn" href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title-3/">Read More �</a>
		                </div>

            </div><!-- .blog-inner -->
           
        </article>

        
        <article id="post-649" class="wpcap-post post-649 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized ast-article-single">
         
            <div class="post-grid-inner">
            	
            				<div class="post-grid-thumbnail">
				<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/hello-world-2/">
					<img width="1280" height="853" src="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/watering-plants-with-a-watering-can-1.jpg" class="attachment-full size-full wp-post-image" alt="" loading="lazy" srcset="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/watering-plants-with-a-watering-can-1.jpg 1280w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/watering-plants-with-a-watering-can-1-300x200.jpg 300w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/watering-plants-with-a-watering-can-1-1024x682.jpg 1024w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/watering-plants-with-a-watering-can-1-768x512.jpg 768w" sizes="(max-width: 1280px) 100vw, 1280px" />				</a>
			</div>
        
                <div class="post-grid-text-wrap">
               				<h2 class="title">
			<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/hello-world-2/">Hello world!</a>
		</h2>
			                	                		<div class="post-grid-excerpt">
			<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>
		</div>
			                		<a class="read-more-btn" href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/hello-world-2/">Read More �</a>
		                </div>

            </div><!-- .blog-inner -->
           
        </article>

        
        <article id="post-647" class="wpcap-post post-647 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized ast-article-single">
         
            <div class="post-grid-inner">
            	
            				<div class="post-grid-thumbnail">
				<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title-2/">
					<img width="390" height="274" src="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-03.jpg" class="attachment-full size-full wp-post-image" alt="" loading="lazy" srcset="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-03.jpg 390w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-03-300x211.jpg 300w" sizes="(max-width: 390px) 100vw, 390px" />				</a>
			</div>
        
                <div class="post-grid-text-wrap">
               				<h2 class="title">
			<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title-2/">page builder Title</a>
		</h2>
			                	                		<div class="post-grid-excerpt">
			<p>Elementor page builder addon to display posts in a grid. Useful for generating post grid from&hellip;</p>
		</div>
			                		<a class="read-more-btn" href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title-2/">Read More �</a>
		                </div>

            </div><!-- .blog-inner -->
           
        </article>

        
        <article id="post-642" class="wpcap-post post-642 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized ast-article-single">
         
            <div class="post-grid-inner">
            	
            				<div class="post-grid-thumbnail">
				<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title/">
					<img width="390" height="274" src="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-01.jpg" class="attachment-full size-full wp-post-image" alt="" loading="lazy" srcset="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-01.jpg 390w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-01-300x211.jpg 300w" sizes="(max-width: 390px) 100vw, 390px" />				</a>
			</div>
        
                <div class="post-grid-text-wrap">
               				<h2 class="title">
			<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title/">page builder Title</a>
		</h2>
			                	                		<div class="post-grid-excerpt">
			<p>Elementor page builder addon to display posts in a grid. Useful for generating post grid from&hellip;</p>
		</div>
			                		<a class="read-more-btn" href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/page-builder-title/">Read More �</a>
		                </div>

            </div><!-- .blog-inner -->
           
        </article>

        
        <article id="post-633" class="wpcap-post post-633 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized ast-article-single">
         
            <div class="post-grid-inner">
            	
            				<div class="post-grid-thumbnail">
				<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/blog-grid-title-2021/">
					<img width="390" height="274" src="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-05.jpg" class="attachment-full size-full wp-post-image" alt="" loading="lazy" srcset="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-05.jpg 390w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/projects-05-300x211.jpg 300w" sizes="(max-width: 390px) 100vw, 390px" />				</a>
			</div>
        
                <div class="post-grid-text-wrap">
               				<h2 class="title">
			<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/blog-grid-title-2021/">Blog grid title 2021</a>
		</h2>
			                	                		<div class="post-grid-excerpt">
			<p>Elementor page builder addon to display posts in a grid. Useful for generating post grid from&hellip;</p>
		</div>
			                		<a class="read-more-btn" href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/blog-grid-title-2021/">Read More �</a>
		                </div>

            </div><!-- .blog-inner -->
           
        </article>

        
        <article id="post-1" class="wpcap-post post-1 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized ast-article-single">
         
            <div class="post-grid-inner">
            	
            				<div class="post-grid-thumbnail">
				<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/hello-world/">
					<img width="1920" height="1299" src="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/white-mountain-bike-parks-near-white-concrete-poster-on-gray-1.jpg" class="attachment-full size-full wp-post-image" alt="" loading="lazy" srcset="https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/white-mountain-bike-parks-near-white-concrete-poster-on-gray-1.jpg 1920w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/white-mountain-bike-parks-near-white-concrete-poster-on-gray-1-300x203.jpg 300w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/white-mountain-bike-parks-near-white-concrete-poster-on-gray-1-1024x693.jpg 1024w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/white-mountain-bike-parks-near-white-concrete-poster-on-gray-1-768x520.jpg 768w, https://viarchtechnologies.com/projects/coachthem/blog/wp-content/uploads/2020/07/white-mountain-bike-parks-near-white-concrete-poster-on-gray-1-1536x1039.jpg 1536w" sizes="(max-width: 1920px) 100vw, 1920px" />				</a>
			</div>
        
                <div class="post-grid-text-wrap">
               				<h2 class="title">
			<a href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/hello-world/">Hello world!</a>
		</h2>
			                	                		<div class="post-grid-excerpt">
			<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>
		</div>
			                		<a class="read-more-btn" href="https://viarchtechnologies.com/projects/coachthem/blog/2020/11/10/hello-world/">Read More �</a>
		                </div>

            </div><!-- .blog-inner -->
           
        </article>

        
			</div>			      						               
		</div>
				</div>
				</div>
						</div>
					</div>
		</div>
								</div>
					</div>
		</section>
						</div>
						</div>
					</div>
		
		
		
	</div><!-- .entry-content .clear -->

	
	
</article><!-- #post-## -->


					
					
				
			</main><!-- #main -->
			
		
	</div><!-- #primary -->


			
			</div> <!-- ast-container -->

		</div><!-- #content -->
@endsection
