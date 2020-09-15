
if(document.getElementById('my-video')){

    console.log(fluidplayer_var.pre_roll);

    var myFP = fluidPlayer(
        'my-video',
        {
            layoutControls: {
                fillToContainer: true,
                primaryColor: fluidplayer_var.main_color,
                posterImage: fluidplayer_var.poster_img,
                autoPlay: fluidplayer_var.autoplay,
                playButtonShowing: false,
                playPauseAnimation: false,            
                mute: false,
                logo: {
                    imageUrl: fluidplayer_var.logo,
                    position: fluidplayer_var.logo_position,
                    clickUrl: null,
                    opacity: fluidplayer_var.logo_opacity,
                    mouseOverImageUrl: null,
                    imageMargin: fluidplayer_var.logo_margin,
                    hideWithControls: false,
                    showOverAds: false
                },
                htmlOnPauseBlock: {
                    html: fluidplayer_var.ad_pause
                },
                allowDownload: false,
                allowTheatre: false,
                playbackRateEnabled: fluidplayer_var.playback_speed,
                controlBar: {
                    autoHide: true,
                    autoHideTimeout: 3,
                    animated: true
                },
            },				
            vastOptions: {
                "adList" : [
                    {
                    "roll" : "preRoll",
                    "vastTag" : fluidplayer_var.pre_roll
                    },
                    {
                    "roll" : "midRoll",
                    "vastTag" : fluidplayer_var.mid_roll,
                    "timer" : fluidplayer_var.mid_roll_timer
                    }
                    // {
                    // "roll" : "postRoll",
                    // "vastTag" : fluidplayer_var.post_roll
                    // }

                ]
            }
        }
    );

    myFP.on('play', function(){
        jQuery('.ad_before').remove();
    });
        
    myFP.on('pause', function(){
        var adPauseHtml = jQuery('.ad_pause').html();
        jQuery('.happy-inside-player').hide().html(adPauseHtml).fadeIn(300);
    });
}