<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/13/2017
 * Time: 3:36 AM
 */
?>
<link href="<?php echo public_url('css/menu.css') ?>" rel="stylesheet" type="text/css">
<header>
            <nav role="navigation">
                <ul>
                    <?php foreach ($category_list as $row):?>
                        <?php $name = convert_vi_to_en($row->name);
                        $name = strtolower($name);
                        ?>
                    <li>
                        <a style="text-decoration: none" href="<?php echo base_url($name.'-c'.$row->id)?>"
                           title="<?php echo $row->name?>">
                        <div>
                            <?php echo $row->name?>
                            <span>carrot shop</span>
                            </div>
                        </a><div>
                            <?php if (!empty($row->sub)):?>
                                <ul>
                                <?php foreach ($row->sub as $sub):?>
                                    <?php $name = convert_vi_to_en($sub->name);
                                    $name = strtolower($name);
                                    ?>
                                    <li>
                                    <a href="<?php echo base_url($name.'-c'.$sub->id)?>"><?php echo $sub->name?></a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            <?php endif;?>
                    </li>
                    <?php endforeach;?>
                </ul>
            </nav>
</header>

