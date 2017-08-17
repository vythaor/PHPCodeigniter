<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 5/1/2017
 * Time: 6:53 PM
 */
$price_from_select = isset($price_from) ? intval($price_from) : 0;
$price_to_select = isset($price_to) ? intval($price_to) : 0;
?>
<div>
   <!-- <h4> Tìm kiếm theo giá </h4>-->
    <form method="get"
          action="<?php echo site_url('product/search_price') ?>" name="search">
        <table cellspacing="10" >
            <tr>
                <td>Giá từ:<span class="req">*</span></td><td>&nbsp;</td>
                <td>
                    <select class="form-control" id="price_from" name="price_from" style="width:120px;">
                    <?php for ($i = 0; $i <= 5000000; $i = $i + 50000): ?>
                            <option <?php echo ($price_to_select == $i) ? 'selected' : '' ?>
                            value="<?php echo $i ?>"><?php echo number_format($i) ?> đ
                            </option>
                    <?php endfor; ?>
                    </select>
                    <div class="clear"></div>
                    <div class="error" id="price_from_error"></div>
                </td>
                <td>&nbsp;</td>
                <td>Giá tới:<span class="req">*</span></td><td>&nbsp;</td>
                <td>
                    <select class="form-control" id="price_to" name="price_to" style="width:120px;">
                        <?php for ($i = 0; $i <= 5000000; $i = $i + 50000): ?>
                            <option <?php echo ($price_to_select == $i) ? 'selected' : '' ?>
                                    value="<?php echo $i ?>"><?php echo number_format($i) ?> đ
                            </option>
                        <?php endfor; ?>
                    </select>
                    <div class="clear"></div>
                    <div class="error" id="price_from_error"></div>
                    <div class="clear"></div>
                </td>
                <td>&nbsp;</td>
                <td><input class="btn btn-success" name="search" value="Tìm kiếm"
                           style="height:30px !important;line-height:30px !important;padding:0px 10px !important;"
                           type="submit">
                    <!--<button class="btn btn-default" type="submit" style="height: 24px">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>-->
                </td>
            </tr>
        </table>
    </form>
</div>
