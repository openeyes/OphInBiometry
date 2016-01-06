<div class="element-data">
    <?php
    if (empty($element->{'lens_' . $side})) {
        ?>
        <div class="row data-row">
            <div class="large-12 column">
                <div
                    class="data-label">
                    <?php
                    echo 'No selection has been made - use edit mode to select a lens.';
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="row data-row">
            <div class="large-6 column">
                <div
                    class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('lens_id_' . $side)) ?>
                </div>
            </div>
            <div class="large-6 column end">
                <div class="data-value iolDisplay"
                     id="lens_<?php echo $side ?>"><?php echo $element->{'lens_' . $side} ? $element->{'lens_' . $side}->name : 'None' ?></div>
            </div>
        </div>
        <div class="row field-row">
            <div class="large-6 column">
                <div class="data-label">A constant</div>
            </div>
            <div class="large-6 column">
                <div class="data-value"
                     id="acon_<?php echo $side ?>"><?php echo(($element->{'lens_' . $side}) ? number_format($element->{'lens_' . $side}->acon, 1) : 'None') ?></div>
            </div>
        </div>
        <div class="row data-row">
            <div class="large-6 column">
                <div
                    class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('iol_power_' . $side)) ?></div>
            </div>
            <div class="large-6 column end">
                <div class="iolDisplay"><?php echo CHtml::encode(number_format((float)$element->{'iol_power_' . $side}, 2, '.', '')) ?></div>
            </div>
        </div>
        <div class="row data-row">
            <div class="large-6 column">
                <div
                    class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('predicted_refraction_' . $side)) ?></div>
            </div>
            <div class="large-6 column end">
                <div class="data-value"
                     id="tr_<?php echo $side ?>"><?php echo CHtml::encode($element->{'predicted_refraction_' . $side}) ?></div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
