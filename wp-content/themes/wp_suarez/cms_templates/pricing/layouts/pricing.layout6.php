<article <?php post_class(); ?>>
    <h3 class="cs-pricing-title"><?php echo get_the_title(); ?></h3>
    <div class="cs-pricing-description">
        <dl class="loaded">
            <dt style="display:none;"></dt> <?php /* add this element for fix w3c validator */?>
            <?php if($custom['price'][0] != '' || $custom['per_time'][0] != '') { ?>
            <dt class="jmPrice">
                <div class="cs-pricing-wrap">
                    <div class="cs-pricing-inner">
                        <?php if($custom['price'][0] != '') { ?>
                            <div class="number"><?php echo $custom['price'][0] ?><span>$</span></div>
                        <?php } ?>
                        <?php if($custom['value'][0] != '') { ?>
                            <small>/per <?php echo $custom['value'][0] ?></small>
                        <?php } ?>
                    </div>
                </div>
            </dt>
            <?php } ?>
            <?php if($custom['option_1'][0] != '') { ?>
            <dd class="odd"><?php echo $custom['option_1'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_2'][0] != '') { ?>
            <dd class="retail"><?php echo $custom['option_2'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_3'][0] != '') { ?>
            <dd class="odd"><?php echo $custom['option_3'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_4'][0] != '') { ?>
            <dd class="retail"><?php echo $custom['option_4'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_5'][0] != '') { ?>
            <dd class="cs-option-5"><?php echo $custom['option_5'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_6'][0] != '') { ?>
            <dd class="cs-option-6"><?php echo $custom['option_6'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_7'][0] != '') { ?>
            <dd class="cs-option-7"><?php echo $custom['option_7'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_8'][0] != '') { ?>
            <dd class="cs-option-8"><?php echo $custom['option_8'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_9'][0] != '') { ?>
            <dd class="cs-option-9"><?php echo $custom['option_9'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_10'][0] != '') { ?>
            <dd class="cs-option-10"><?php echo $custom['option_10'][0] ?></dd>
            <?php } ?>
        </dl>
    </div>
    <div class="cs-pricing-button">
        <a title="<?php get_the_title() ?>" href="<?php echo esc_url($custom['button_url'][0]); ?>" rel="" class="btn <?php echo $button_type;?>"><?php echo $custom['button_text'][0]; ?></a>
    </div>
</article>

<style type="text/css" scoped>
    .cs-pricing.pricing-layout6 .cs-pricing-item .cs-pricing-container{
        border:1px solid <?php echo $feature_item_bg;?>;
        background: <?php echo $item_bg;?>;
    }
    .pricing-layout6 .cs-pricing-item:hover .cs-pricing-container,
    .pricing-layout6 .cs-pricing-item.cs-pricing-feature .cs-pricing-container,
    .pricing-layout6 .cs-pricing-item .cs-pricing-wrap,
    .pricing-layout6 .cs-pricing-item:hover .cs-pricing-title,
    .pricing-layout6 .cs-pricing-item.cs-pricing-feature .cs-pricing-title{background:<?php echo $feature_item_bg;?>; }
    .pricing-layout6 .cs-pricing-item .cs-pricing-title{ color:<?php echo $title_pricing_color; ?>; background-color:<?php echo $item_bg;?>;}
    .pricing-layout6 .cs-pricing-item:hover .cs-pricing-wrap,
    .pricing-layout6 .cs-pricing-item.cs-pricing-feature .cs-pricing-wrap{ background: <?php echo $item_bg;?>;}

    .pricing-layout6 .cs-pricing-item .cs-pricing-title,
    .pricing-layout6 .cs-pricing-item .cs-pricing-description dd{border-bottom-color:<?php echo $feature_item_bg;?>;}
    .pricing-layout6 .cs-pricing-item.cs-pricing-feature .cs-pricing-title,
    .pricing-layout6 .cs-pricing-item:hover .cs-pricing-title,
    .pricing-layout6 .cs-pricing-item .cs-pricing-description dd,
    .pricing-layout6 .cs-pricing-item:hover .loaded dd{border-bottom-color:<?php echo $item_bg;?>;}

    .pricing-layout6 .cs-pricing-button a {background:<?php echo $button_background_pricing_color;?>;color:<?php echo $button_font_pricing_color;?>;}
</style>