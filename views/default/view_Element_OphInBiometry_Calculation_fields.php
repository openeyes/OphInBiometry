<div class="element-data">
    <?php
    if ($this->is_auto) {
        $data = OphInBiometry_Calculation_Formula::Model()->findAllByAttributes(
            array(
                'id' => $this->selectionValues[0]->{"formula_id_$side"},
            ));
              $data1 = Element_OphInBiometry_IolRefValues::Model()->findAllByAttributes(
                    array(
                        'event_id' => $this->event->id,
                        'lens_id' => $this->selectionValues[0]->{"lens_id_$side"},
                        'formula_id' => $this->selectionValues[0]->{"formula_id_$side"},
                    ));
     ?>
            <div class="row data-row">
                <div class="large-4 column">
                    <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('formula_id_' . $side)) ?>
                        &nbsp;Used:
                    </div>
                </div>
                <div class="large-2 column">
                    <div class="data-value"><?php  foreach ($data as $k => $v) { echo $v->{"name"}; }?>&nbsp;</div>
                </div>
                <div class="large-4 column">
                    <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('emmetropia_' . $side)) ?>
                        :
                    </div>
                </div>
                <div class="large-2 column">
                    <div class="data-value"><?php foreach ($data1 as $k1 => $v1) { echo $v1->{"emmetropia_$side"};} ?>&nbsp;</div>
                </div>
            </div>
    <?php
    }
    ?>
    <div class="row data-row">
        <div class="large-6 column">
            <div
                class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('target_refraction_' . $side)) ?></div>
        </div>
        <div class="large-6 column end">
            <div class="data-value"><?php echo CHtml::encode($element->{'target_refraction_' . $side}) ?></div>
        </div>
    </div>
</div>