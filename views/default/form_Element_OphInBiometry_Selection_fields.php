<div class="element-fields">
    <?php
    if ($this->is_auto) {
        $post = Yii::app()->request->getPost('Element_OphInBiometry_Selection');
        if ($element->isNewRecord && empty($post)) {
            $element->lens_id_left = null;
            $element->lens_id_right = null;
        }
        foreach ($this->iolRefValues as $measurementData) {
            if ($measurementData->{"eye_id"} == 3) {
                $lens_left[] = $measurementData->{"lens_id"};
                $formulas_left[] = $measurementData->{"formula_id"};
                $iolrefdata_left[$measurementData->{"lens_id"}][$measurementData->{"formula_id"}] = $measurementData->{"iol_ref_values_$side"};
                $iolrefdata["left"][$measurementData->{"lens_id"}][$measurementData->{"formula_id"}] = $measurementData->{"iol_ref_values_$side"};

            } elseif ($measurementData->{"eye_id"} == 1) {
                $lens_right[] = $measurementData->{"lens_id"};
                $formulas_right[] = $measurementData->{"formula_id"};
                $iolrefdata_right[$measurementData->{"lens_id"}][$measurementData->{"formula_id"}] = $measurementData->{"iol_ref_values_$side"};
                $iolrefdata["right"][$measurementData->{"lens_id"}][$measurementData->{"formula_id"}] = $measurementData->{"iol_ref_values_$side"};
            }

        }
        ?>
        <div class="row">
            <div class="large-4 column">
                <span class="field-info">Lens:</span>
            </div>
            <div class="large-8 column">
                <?php
                if ($side == "left") {
                    echo
                    CHtml::dropDownList('Element_OphInBiometry_Selection_lens_id_' . $side, 'lens_id',
                        CHtml::listData(
                            OphInBiometry_LensType_Lens::model()->findAll($criteria->condition = "id in (" . implode(",", array_unique($lens_left)) . ")", array('order' => 'display_order')),
                            'id',
                            'name'
                        ),
                        array(
                            'empty' => '- Select Lens -',
                            'options' => array(1 => array('selected' => true)),
                            'class' => 'classname'
                        )
                    );
                } else {
                    echo
                    CHtml::dropDownList('Element_OphInBiometry_Selection_lens_id_' . $side, 'lens_id',
                        CHtml::listData(
                            OphInBiometry_LensType_Lens::model()->findAll($criteria->condition = "id in (" . implode(",", array_unique($lens_right)) . ")", array('order' => 'display_order')),
                            'id',
                            'name'
                        ),
                        array(
                            'empty' => '- Select Lens -',
                            'options' => array(1 => array('selected' => true)),
                            'class' => 'classname'
                        )
                    );
                }
                ?>
            </div>
        </div>

        <?php
    } else {
        ?>
        <div class="row">
            <div class="large-12 column">
                <?php
                //We should move this code to the controller some point of time.
                $post = Yii::app()->request->getPost('Element_OphInBiometry_Selection');
                if ($element->isNewRecord && empty($post)) {
                    $element->lens_id_left = null;
                    $element->lens_id_right = null;
                }
                echo $form->dropDownList($element, 'lens_id_' . $side, CHtml::listData(OphInBiometry_LensType_Lens::model()->activeOrPk($element->{'lens_id_' . $side})->findAll(array('order' => 'display_order asc')), 'id', 'name'), array('empty' => '- Please select -'), null, array('label' => 3, 'field' => 6))
                ?>
            </div>
        </div>

        <?php
    }
    ?>
    <div class="row">
        <div class="large-12 column">
            <div class="row field-row">
                <div class="large-4 column">
                    <span class="field-info">Lens Description:</span>
                </div>
                <div class="large-8 column">
                    <span id="type_<?php echo $side ?>"
                          class="field-info"><?php echo $element->{'lens_' . $side} ? $element->{'lens_' . $side}->description : '' ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="large-12 column">
            <div class="row field-row">
                <div class="large-4 column">
                    <span class="field-info">Lens A constant:</span>
                </div>
                <div class="large-8 column">
                    <span id="acon_<?php echo $side ?>"
                          class="field-info"><?php echo $element->{'lens_' . $side} ? number_format($element->{'lens_' . $side}->acon, 1) : '' ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($this->is_auto) {
        ?>
        <div class="row">

            <div class="large-4 column">
                <span class="field-info">Formula:</span>
            </div>
            <div class="large-8 column">
                <?php
                if ($side == "left") {
                    echo
                    CHtml::dropDownList('Element_OphInBiometry_Selection_formula_id_' . $side, 'formula_id',
                        CHtml::listData(
                            OphInBiometry_Calculation_Formula::model()->findAll($criteria->condition = "id in (" . implode(",", array_unique($formulas_left)) . ")", array('order' => 'display_order')),
                            'id',
                            'name'
                        ),
                        array(
                            'empty' => '- Select Formula -',
                            'options' => array(1 => array('selected' => true)),
                            'class' => 'classname'
                        )
                    );
                } else {
                    echo
                    CHtml::dropDownList('Element_OphInBiometry_Selection_formula_id_' . $side, 'formula_id',
                        CHtml::listData(
                            OphInBiometry_Calculation_Formula::model()->findAll($criteria->condition = "id in (" . implode(",", array_unique($formulas_right)) . ")", array('order' => 'display_order')),
                            'id',
                            'name'
                        ),
                        array(
                            'empty' => '- Select Formula -',
                            'options' => array(1 => array('selected' => true)),
                            'class' => 'classname'
                        )
                    );
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="large-12 column">
                <?php
                if ($side == "left") {
                    $iolrefdata_left = $iolrefdata['left'];
                    foreach ($iolrefdata_left as $k => $v) {
                        foreach ($v as $key => $value) {
                            if (!empty($value)) {
                                // echo "<br>" . $value;
                                $iolData = json_decode($value, true);
                                $divid = $side . '_' . $k . '_' . $key;
                                echo '<table id=' . $divid . '><tr><th>#</th> <th>IOL</th><th>REF</th>';
                                for ($j = 0; $j < count($iolData['IOL']); $j++) {
                                    echo "<tr><td><input type='radio'  id='iolrefval_$j' name='iolrefval'></td><td>" . $iolData["IOL"][$j] . "</td><td>" . $iolData["REF"][$j] . "</td></tr>";
                                }
                                echo '</table>';
                            }
                        }
                    }
                } else {
                    $iolrefdata_right = $iolrefdata['right'];
                    foreach ($iolrefdata_right as $k => $v) {
                        foreach ($v as $key => $value) {
                            if (!empty($value)) {
                                $iolData = json_decode($value, true);
                                $divid = $side . '_' . $k . '_' . $key;
                                echo '<table id=' . $divid . '><tr><th>#</th> <th>IOL</th><th>REF</th>';
                                for ($j = 0; $j < count($iolData['IOL']); $j++) {
                                    echo "<tr><td><input type='radio'  id='iolrefval_$j' name='iolrefval'></td><td>" . $iolData["IOL"][$j] . "</td><td>" . $iolData["REF"][$j] . "</td></tr>";
                                }
                                echo '</table>';
                            }

                        }

                    }
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <div id="div_Element_OphInBiometry_Selection_<?php echo $side ?>">
        <?php echo $form->textField($element, 'iol_power_' . $side, ($this->is_auto) ? array('readonly' => true) : null, null, array('label' => 4, 'field' => 2)) ?>
        <?php echo $form->textField($element, 'predicted_refraction_' . $side, ($this->is_auto) ? array('readonly' => true) : null, null, array('label' => 4, 'field' => 2)) ?>
    </div>
</div>