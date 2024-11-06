<?php
header ("Content-Type:text/css");
$color = "#746EF1"; // Change your Color Here

function checkhexcolor($color) {
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
    $color = "#".$_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
    $color = "#746EF1";
}

?>
.boxed-btn,
.counter-area:after,
.counter-area:before,
.our-angels-area .single-team-member .image-box .member-details,
.our-angels-area .single-team-member .image-box .member-details:after,
.minimal-video-area:after,
.subscribe-area,
.footer-area:after,
.boxed-btn.blank:hover,
.sidebar .widget .widget-title,
.sidebar .widget .widget-body li:hover,
.back-to-top,
.blog-page .page-navigation li.active,
.blog-page .page-navigation li:hover,
.subscription-area .subscription-form input[type=submit],
    .contact-area .contact-wrapper .contact-form input[type=submit],
    .navbar-area

{
    background-color:<?php echo $color ?>;
}

.suitable-business-area .left-content .section-title h2,
.icon svg.svg-inline--fa,
.news-feeds-area .single-news-box-item .content .date-meta,
.subscribe-area .subscriber-wrapper .form-wrapper button,
.back-to-top,
.navbar-area ul li a:hover,
    .subscription-area .subscription-form h2 span,
    .section-title h2 span

{
    color:<?php echo $color ?>;
}

.back-to-top
{
    border: 2px solid <?php echo $color ?>;
}

.subscription-area .subscription-form input[type=submit]:hover,
    .contact-area .contact-wrapper .contact-form input[type=submit]:hover
{
    border-color: <?php echo $color ?>;
}

svg.svg-inline--fa.fa-angle-up.fa-w-10
{
   color:#fff
}

<?php if ( $_SERVER['REQUEST_URI'] != "/"){
    echo '.navbar-area{
    background-color: #00000047;
}';
}
?>