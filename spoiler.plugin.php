<?php

Plugin::register(
    __FILE__,
    __('Spoiler', 'spoiler'),
    __('Simple spoiler plugin for Monstra', 'spoiler'),
    '1.0.0',
    'Sergiy Tkach / DevApromix',
    'https://github.com/devapromix-monstra/spoiler'
);

Action::add('theme_header', 'Spoiler::headerCSS');
Action::add('theme_header', 'Spoiler::headerJS');
Action::add('theme_footer', 'Spoiler::footerJS');
Shortcode::add('spoiler', 'Spoiler::shortcode');

class Spoiler {

    public static function headerCSS(){
        echo ('
		<style type="text/css">
		.spoiler .content {
			display:none;
		}
		.spoiler .caption {
			cursor:pointer;
		}
		</style>
		');
    }

	public static function headerJS() {
        echo '<script type="text/javascript" src="'.Option::get('siteurl'). '/public/assets/js/jquery.min.js"></script>';
	}

	public static function footerJS() {
        echo ('
		<script type="text/javascript">
		$( ".caption" ).click(function() {
			$(this).next().toggle();       
		});
		</script>
		');
    }

    public static function shortcode($atr)
    {
        return Spoiler::show($atr['caption'], $atr['content']);
    }

    public function show($caption, $content)
    {
        return View::factory('spoiler/views/frontend/index')
            ->assign('caption', $caption)
            ->assign('content', $content)
            ->render();
    }

}
