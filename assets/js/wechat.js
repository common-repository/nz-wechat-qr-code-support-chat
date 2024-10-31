jQuery( document ).ready(function() {

    jQuery('#footer_qrcode').hide();

    jQuery('#footer_icon').click(function(){
        jQuery('#footer_qrcode').fadeIn( "slow" );
        jQuery('#footer_icon').fadeOut( "slow" );
    })

    jQuery('#close').click(function(){
        jQuery('#footer_qrcode').fadeOut( "slow" );
        jQuery('#footer_icon').fadeIn( "slow" );
    })
});