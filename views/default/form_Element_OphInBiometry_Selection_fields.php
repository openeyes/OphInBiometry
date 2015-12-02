<div class="element-fields">
    <?php

    if ($this->is_auto) {
        $post = Yii::app()->request->getPost('Element_OphInBiometry_Selection');

        if ($element->isNewRecord && empty($post)) {
            $element->lens_id_left = null;
            $element->lens_id_right = null;
        }

        if (empty($this->iolRefValues)) {
            $this->flash_message = "Missing IOL Measurement data";
            Yii::app()->user->setFlash('warning.noiolrefdata', $this->flash_message);
        } else {

            foreach ($this->iolRefValues as $measurementData) {
                if (!empty($measurementData->{"iol_ref_values_left"})) {
                    $lens_left[] = $measurementData->{"lens_id"};
                    $formulas_left[] = $measurementData->{"formula_id"};
                    $iolrefdata_left[$measurementData->{"lens_id"}][$measurementData->{"formula_id"}] = $measurementData->{"iol_ref_values_$side"};
                    $iolrefdata["left"][$measurementData->{"lens_id"}][$measurementData->{"formula_id"}] = $measurementData->{"iol_ref_values_$side"};
                }
                if (!empty($measurementData->{"iol_ref_values_right"})) {
                    $lens_right[] = $measurementData->{"lens_id"};
                    $formulas_right[] = $measurementData->{"formula_id"};
                    $iolrefdata_right[$measurementData->{"lens_id"}][$measurementData->{"formula_id"}] = $measurementData->{"iol_ref_values_$side"};
                    $iolrefdata["right"][$measurementData->{"lens_id"}][$measurementData->{"formula_id"}] = $measurementData->{"iol_ref_values_$side"};
                }
            }
        }
        ?>
        <div class="row">
            <div class="large-12 column">
                <?php
                $criteria = new CDbCriteria();
                if ($side == "left") {
                    if (!empty($lens_left)) {
                        echo $form->dropDownList($element, 'lens_id_' . $side, CHtml::listData(
                            OphInBiometry_LensType_Lens::model()->findAll($criteria->condition = "id in (" . implode(",", array_unique($lens_left)) . ")", array('order' => 'display_order')), 'id', 'name'
                        ), array('empty' => '- Please select -'), null, array('label' => 3, 'field' => 6));
                    }
                } else {
                    if (!empty($lens_right)) {
                        echo $form->dropDownList($element, 'lens_id_' . $side, CHtml::listData(
                            OphInBiometry_LensType_Lens::model()->findAll($criteria->condition = "id in (" . implode(",", array_unique($lens_right)) . ")", array('order' => 'display_order')), 'id', 'name'
                        ), array('empty' => '- Please select -'), null, array('label' => 3, 'field' => 6));

                    }
                }
                ?>
            </div>
        </div>

        <?php
        echo $form->hiddenField($element,'iol_power_' . $side,array('value'=>$element->{"iol_power_$side"}));

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
                <div class="large-3 column">
                    <span class="field-info">Lens Description:</span>
                </div>
                <div class="large-9 column">
                    <span id="type_<?php echo $side ?>"
                          class="field-info"><?php echo $element->{'lens_' . $side} ? $element->{'lens_' . $side}->description : '' ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="large-12 column">
            <div class="row field-row">
                <div class="large-3 column">
                    <span class="field-info">Lens A constant:</span>
                </div>
                <div class="large-9 column">
                    <span id="acon_<?php echo $side ?>"
                          class="field-info"><?php echo $element->{'lens_' . $side} ? number_format($element->{'lens_' . $side}->acon, 1) : '' ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($this->is_auto) {
        echo $form->hiddenField($element,'predicted_refraction_' . $side,array('value'=>$element->{"predicted_refraction_$side"}));
        ?>
        <div class="row">
            <div class="large-12 column">
                <?php
                if ($side == "left") {
                    if (!empty($formulas_left)) {
                        echo $form->dropDownList($element, 'formula_id_' . $side, CHtml::listData(
                            OphInBiometry_Calculation_Formula::model()->findAll($criteria->condition = "id in (" . implode(",", array_unique($formulas_left)) . ")", array('order' => 'display_order')), 'id', 'name'
                        ), array('empty' => '- Please select -'), null, array('label' => 3, 'field' => 6));
                    }
                } else {
                    if (!empty($formulas_right)) {
                        echo $form->dropDownList($element, 'formula_id_' . $side, CHtml::listData(
                            OphInBiometry_Calculation_Formula::model()->findAll($criteria->condition = "id in (" . implode(",", array_unique($formulas_right)) . ")", array('order' => 'display_order')), 'id', 'name'
                        ), array('empty' => '- Please select -'), null, array('label' => 3, 'field' => 6));
                    }
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="large-12 column">
                <?php
                if ($side == "left") {
                    if (!empty($iolrefdata['left'])) {
                        $iolrefdata_left = $iolrefdata['left'];
                        foreach ($iolrefdata_left as $k => $v) {
                            foreach ($v as $key => $value) {
                                if (!empty($value)) {
                                    $iolData = json_decode($value, true);
                                    $divid = $side . '_' . $k . '_' . $key;
                                    $found = 0;
                                    echo '<table id=' . $divid . '><tr><th>#</th> <th>IOL</th><th>REF</th>';
                                    for ($j = 0; $j < count($iolData['IOL']); $j++) {
                                        $radid = $side . '_' . $k . '_' . $key . '__' . $j;
                                        if (($this->selectionValues[0]->{"predicted_refraction_left"} == $iolData["REF"][$j]) && ($this->selectionValues[0]->{"iol_power_left"} == $iolData["IOL"][$j])) {
                                            $found = 1;
                                            echo "<tr  class='highlighted'  id='iolreftr-$radid'><td><input type='radio' checked  id='iolrefrad-$radid' name='iolrefval_left'></td><td>" . $iolData["IOL"][$j] . "</td><td>" . $iolData["REF"][$j] . "</td></tr>";
                                        } else {
                                            echo "<tr id='iolreftr-$radid'><td><input type='radio'  id='iolrefrad-$radid' name='iolrefval'></td><td>" . $iolData["IOL"][$j] . "</td><td>" . $iolData["REF"][$j] . "</td></tr>";
                                        }
                                        echo "<input type='hidden'  id='iolval-$radid' value=" . $iolData["IOL"][$j] . "><input type='hidden'  id='refval-$radid' value=" . $iolData["REF"][$j] . ">";
                                    }
                                    echo '</table>';
                                }
                            }
                        }
                    }
                } else {
                    if (!empty($iolrefdata['right'])) {
                        $iolrefdata_right = $iolrefdata['right'];
                        foreach ($iolrefdata_right as $k => $v) {
                            foreach ($v as $key => $value) {
                                if (!empty($value)) {
                                    $iolData = json_decode($value, true);
                                    $divid = $side . '_' . $k . '_' . $key;
                                    $found = 0;
                                    echo '<table id=' . $divid . '><tr><th>#</th> <th>IOL</th><th>REF</th>';
                                    for ($j = 0; $j < count($iolData['IOL']); $j++) {
                                        $radid = $side . '_' . $k . '_' . $key . '__' . $j;
                                        if (($this->selectionValues[0]->{"predicted_refraction_right"} == $iolData["REF"][$j]) && ($this->selectionValues[0]->{"iol_power_right"} == $iolData["IOL"][$j])) {
                                            $found = 1;
                                            echo "<tr class='highlighted' id='iolreftr-$radid'><td><input type='radio' checked id='iolrefrad-$radid' name='iolrefval_right'></td><td>" . $iolData["IOL"][$j] . "</td><td>" . $iolData["REF"][$j] . "</td></tr>";
                                        } else {
                                            echo "<tr id='iolreftr-$radid'><td><input type='radio'  id='iolrefrad-$radid' name='iolrefval'></td><td>" . $iolData["IOL"][$j] . "</td><td>" . $iolData["REF"][$j] . "</td></tr>";
                                        }
                                        echo "<input type='hidden'  id='iolval-$radid' value=" . $iolData["IOL"][$j] . "><input type='hidden'  id='refval-$radid' value=" . $iolData["REF"][$j] . ">";
                                    }
                                    echo '</table>';
                                }

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
        <?php
        if ($this->is_auto) {
        ?>
        <div class="row">
            <div class="large-12 column">
                <div class="row field-row">
                    <div class="large-3 column">
                        <span class="field-info">IOL Power:</span>
                    </div>
                    <div class="large-9 column">
                    <span id="iolpower_<?php echo $side ?>"
                          class="field-info"><span  id="iol_power_<?php echo $side ?>" class="readonly-box box-margin"><?php echo $element->{"iol_power_$side"}; ?></span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 column">
                <div class="row field-row">
                    <div class="large-3 column">
                        <span class="field-info">Predicted Refraction:</span>
                    </div>
                    <div class="large-9 column">
                <span id="preref_<?php echo $side ?>"
                      class="field-info"><span id="predicted_refraction_<?php echo $side ?>" class="readonly-box box-margin"><?php echo $element->{"predicted_refraction_$side"}; ?></span></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
       //     echo $form->hiddenField($element,'iol_power_' . $side,array('value'=>$element->{"iol_power_$side"}));
        //    echo $form->hiddenField($element,'predicted_refraction_' . $side,array('value'=>$element->{"predicted_refraction_$side"}));
        }
        else
        {
            ?>

        <?php echo $form->textField($element, 'iol_power_' . $side, ($this->is_auto) ? array('readonly' => true) : null, null, array('label' => 4, 'field' => 2)) ?>
        <?php echo $form->textField($element, 'predicted_refraction_' . $side, ($this->is_auto) ? array('readonly' => true) : null, null, array('label' => 4, 'field' => 2)) ?>
        <?php
        }
        ?>
    </div>
</div>