<?php
include_once 'classes/dietician.php';
 
$dietician = new dietician($db);
$show_form = $dietician->validCheckinTime($_SESSION['email']);
?>
<div id="checkinPanel" class="contentPanel">
    <?php if($show_form){?>
    <form id="checkinFrm" name="checkinFrm" method="post" action="#" onsubmit="return validateCheckin()">   
        <table>
            <tr>
                <td><label for="weight">Weight(lbs)</label></td>
                <td>
                    <table>
                        <tr>
                            <td><input type="text" id="weight" placeholder="lbs" name="weight" size="4"></td>
                            <td><span id="weight_error" class="error-bubble checkin_error" >#</span></td>
                        </tr>
                    </table>
                   
                </td>
            </tr>
            <tr>
                <td><label for="diary">Food ate today <span class="required">*</span></label></td>
                <td>
                    <table>
                        <tr>
                            <td><textarea name="diary" id="diary"></textarea></td>
                            <td><span id="diary_error" class="error-bubble checkin_error" >#</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><label for="calories">Estimate total calories consumed <span class="required">*</span></label></td>
                <td>
                    <table>
                        <tr>
                            <td><input type="text" size="4" id="calories" name="calories"></td>
                            <td><span id="calories_error" class="error-bubble checkin_error" >#</span></td>
                        </tr>
                    </table>
                    
                    
                </td>
            </tr>
            <tr>
                <td><label for="obstacles">Obstacles Encountered</label></td>
                <td><textarea id="obstacles" name="obstacles"></textarea></td>
            </tr>
            <tr>
                <td><label for="solution">Solutions to Obstacles Encountered</label></td>
                <td><textarea id="solution" name="solution"></textarea></td>
            </tr>
            <tr>
                <td><label for="whylose">Why do you want to lose <span class="required">*</span></label></td>
                <td>
                    <table>
                        <tr>
                            <td><textarea id="whylose" name="whylose"></textarea></td>
                            <td><span id="whylose_error" class="error-bubble checkin_error" >#</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="check_in" id="check_in" class="lt-button-submit" value="Check In"></td>
            </tr>
            <tr>
                <td colspan="2"><span class="required">*</span> - Required Field</td>
            </tr>
        </table>    
 </form>
    <?php }else{ 
        echo "Not time to check-in as yet.";
    }?>
</div>