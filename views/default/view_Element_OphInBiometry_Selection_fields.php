<div class="element-data">
    <?php
    if (empty($element->{'lens_' . $side})) {
        echo 'No selection has been made - use edit mode to select a lens.';
    } else {
        ?>
        <div class="row data-row">
            <div class="large-3 column">
                <div
                    class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('lens_id_' . $side)) ?>
                </div>
            </div>
            <div class="large-9 column end">
                <div class="data-value"
                     id="lens_<?php echo $side ?>"><?php echo $element->{'lens_' . $side} ? $element->{'lens_' . $side}->name : 'None' ?></div>
            </div>
        </div>
        <div class="row field-row">
            <div class="large-3 column">
                <div class="data-label">Description</div>
            </div>
            <div class="large-9 column">
                <div class="data-value"
                     id="type_<?php echo $side ?>"><?php echo $element->{'lens_' . $side} ? $element->{'lens_' . $side}->description : 'None' ?></div>
            </div>
        </div>
        <div class="row field-row">
            <div class="large-3 column">
                <div class="data-label">A constant</div>
            </div>
            <div class="large-9 column">
                <div class="data-value"
                     id="acon_<?php echo $side ?>"><?php echo(($element->{'lens_' . $side}) ? number_format($element->{'lens_' . $side}->acon, 1) : 'None') ?></div>
            </div>
        </div>
        <div class="row data-row">
            <div class="large-3 column">
                <div
                    class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('iol_power_' . $side)) ?></div>
            </div>
            <div class="large-9 column end">
                <div class="iolDisplay"><?php echo CHtml::encode($element->{'iol_power_' . $side}) ?></div>
            </div>
        </div>
        <div class="row data-row">
            <div class="large-3 column">
                <div
                    class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('predicted_refraction_' . $side)) ?></div>
            </div>
            <div class="large-9 column end">
                <div class="data-value"
                     id="tr_<?php echo $side ?>"><?php echo CHtml::encode($element->{'predicted_refraction_' . $side}) ?></div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
