<?php
/* Smarty version 3.1.31, created on 2017-11-17 14:32:20
  from "/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/pdf.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a0ef2f4d5f261_71474472',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'feb2c6850926fc88adb4cdb25d68c110b566dea5' => 
    array (
      0 => '/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/pdf.tpl',
      1 => 1510928503,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a0ef2f4d5f261_71474472 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=1024">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Invoice </title>


    <style>

        body {
            margin: 10px;
            font-weight: normal;
            font-family: arial, helvetica, sans-serif;
            color: #2B3E51;

        }

        .title {
            font-size: 60px;
        }

        .bold {
            font-weight: bold;
        }

        .container {
            background-color: #f6f6f6;
            padding: 70px;

        }

        .red {
            color: #E74C3C;
        }

        .green {
            color: #008000;
        }

        .center {
            text-align: center;
        }

        .box {
            background-color: #ffffff;
            padding: 50px;
            border: 6px solid #f1f1f1;
            margin-bottom: 50px;
            box-sizing: border-box;

        }

        .box2 {
            background-color: #f1f1f1;
            border-bottom: 6px solid #000000;
            box-sizing: border-box;
            padding: 50px;
        }

        .text {
            margin-top: 55px;
            margin-bottom: 55px;
        }

        .text1 {

            padding-top: 75px;
            margin-bottom: 55px;
        }

        .number {
         width: 100px;
            color: white;
            /*text-align: center;*/
            position: relative;
        }

        .number img {
            position: absolute;
            left: -100px;
        }

        .number span {
            position: absolute;
            left: -75px;
            font-size: 70px;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .fly-type, .fly-price, .fly-text {
            width: 30%;
            padding-left: 60px;
        }

        .fly-text {
            color: #f1adad;
        }

        .banner {
            width: 30%;
            margin-top: 20px;
        }

        .img {
            width: 150px;
            /*height: 70px;*/
            vertical-align: middle;
            padding-right: 30px;
        }

        img {
            width: 100%;
        }

        .rout-block {
            width: 90%;
        }

        .box.size-all {
            padding: 0;
        }

        .t-p {
            padding-top: 20px;
        }

        .p-r {
            padding-right: 65px;
        }

        .text-code {
            width: 15%;
            text-align: center;
        }

        .text-from, .text-to {
            width: 37%;
        }

        .footer {
            background-color: #2D465A;
            color: #ffffff;
            padding: 60px;
        }

        .footer .t1 {
            width: 25%;
            padding: 30px 30px 30px 0;
            border-right: 1px dotted #ffffff;
        }

        .footer .t2 {
            width: 20%;
            padding-left: 30px;
            padding-top: 30px;

        }

        .footer .t3 {
            width: 30%;
            padding: 30px;

        }

        table, tr, td {
            width: 100%;
            vertical-align: top;
        }

        .logo {
            margin-bottom: 50px;
        }
        .layover{
            background-color: #f1f1f1;
            padding: 0;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <table>
            <tr>
                <td class="image-logo"><img style="width: 500px" src="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
images/cheap-first-class-logo.png"></td>
                <td style="width: 50%; font-size: 90px;" class="red right">800-818-2451</td>
            </tr>
        </table>

    </div>
    <div class="box box1">
        <div class="title">Dear Customer,</div>
        <div class="text ">My name is Joe, I'm your personal travel expert. Below you will find information on the
            itinerary
            from Hong Kong - Chek Lap Kok International Airport to New York - John F Kennedy
            International Airport customized specially for your needs.
        </div>
    </div>
    <div class="text1 title">Quick Summary of Available Itineraries</div>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pdfs']->value, 'row', false, 'Key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['Key']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
        <div class="box">

            <table>

                <tr>
                    <td style="width: 100px">
                        <div class="left number">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
css-image/dot.png" alt="">
                            <span><?php echo $_smarty_tpl->tpl_vars['Key']->value+1;?>
</span></div>
                    </td>
                    <td class=" fly-type"><?php if ($_smarty_tpl->tpl_vars['row']->value['data']['stops']) {
echo $_smarty_tpl->tpl_vars['row']->value['data']['stops'];?>
 Stop<?php if ($_smarty_tpl->tpl_vars['row']->value['data']['stops'] > 1) {?>s<?php }?> <?php } else { ?>Nonstop <?php }?></td>
                    <td class="bold fly-price red">$<?php echo $_smarty_tpl->tpl_vars['row']->value['data']['price'];?>
</td>
                    <td style="width: 40%" class=" fly-text">Check details below</td>
                </tr>


            </table>

        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

    <table>
        <tr>
            <td class="box left banner">
                <table>
                    <tr>
                        <td class="img left"><img src="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
css-image/kruis.png" alt=""></td>
                        <td style="width: auto;">
                            <div class="t-p bold">Fares are not guaranteed until
                                tickets are issueddd.
                            </div>
                            <div class="font-normal t-p">I encourage you to call me with any
                                questions you have.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="box left banner">
                <table>
                    <tr>
                        <td class="img left">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
css-image/tel.png" alt="">
                        </td>
                        <td style="width: auto;">
                            <div class="font-normal t-p">To book or for additional options</div>
                            <div class="red t-p">800-818-2451</div>
                            <div class="font-normal t-p">or 24/7 via email <br>
                                <a href="mailto:adv.cheapfirstclass@gmail.com">adv.cheapfirstclass@gmail.com</a></div>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
    <div class="text1 title">Flight Details</div>
    <div class="box ">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pdfs']->value, 'row', false, 'Key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['Key']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
            <table>

                <tr>
                    <td>
                        <div class="left number">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
css-image/dot.png" alt="">
                            <span><?php echo $_smarty_tpl->tpl_vars['Key']->value+1;?>
</span></div>
                    </td>
                    <td class="right bold red p-r"> $<?php echo $_smarty_tpl->tpl_vars['row']->value['data']['price'];?>
</td>
                    <td class="right font-normal p-r">per pessenger</td>

                </tr>

            </table>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['row']->value['data']['values'], 'flight');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['flight']->value) {
?>
                <div class="box size-all">
                    <div class="box2 t-p">
                        <table>
                            <tr>
                                <td class="left rout-block  ">
                                    <div class="dest-title">
                                        <?php echo $_smarty_tpl->tpl_vars['flight']->value['from'];?>
 <?php echo $_smarty_tpl->tpl_vars['flight']->value['from_code'];?>
 -
                                        <?php echo $_smarty_tpl->tpl_vars['flight']->value['to'];?>
 <?php echo $_smarty_tpl->tpl_vars['flight']->value['to_code'];?>

                                    </div>
                                    <div class="dest-date  font-normal t-p">(<?php echo $_smarty_tpl->tpl_vars['flight']->value['departure'];?>
)</div>
                                </td>
                                <td style="width: auto;"><?php echo $_smarty_tpl->tpl_vars['flight']->value['departure'];?>
</td>
                            </tr>
                        </table>
                    </div>
                    <div class="t-p" style="width: 100%">
                        <table>
                            <tr>
                                <td class="text-code center">
                                    <div class=""></div>
                                    <div class="bold"><?php echo $_smarty_tpl->tpl_vars['row']->value['data']['code'];?>
</div>
                                </td>
                                <td class="text-from left">
                                    <div><span class="bold"><?php echo $_smarty_tpl->tpl_vars['flight']->value['from_code'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['flight']->value['departure_time'];?>
</div>
                                    <div class="font-normal"><?php echo $_smarty_tpl->tpl_vars['flight']->value['from'];?>

                                    </div>
                                    <div class="t-p font-normal"><?php echo $_smarty_tpl->tpl_vars['flight']->value['departure'];?>
</div>
                                </td>
                                <?php if ($_smarty_tpl->tpl_vars['flight']->value['stops_from']) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['flight']->value['stops_from'], 'stop', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['stop']->value) {
?>
                                <td class="text-to left">
                                    <div><span class="bold"><?php echo $_smarty_tpl->tpl_vars['stop']->value['to_code'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['stop']->value['arrival_time'];?>
</div>
                                    <div class="font-normal"><?php echo $_smarty_tpl->tpl_vars['stop']->value['to'];?>

                                    </div>
                                    <div class="t-p font-normal"><?php echo $_smarty_tpl->tpl_vars['stop']->value['arrival_date'];?>
</div>

                                </td>
                                <td style="width: auto;">
                                    <div class=""><?php echo $_smarty_tpl->tpl_vars['stop']->value['travel_time'];?>
</div>
                                    <div class=" l"><?php echo $_smarty_tpl->tpl_vars['stop']->value['class'];?>
</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                             <div class="center layover" > <?php echo $_smarty_tpl->tpl_vars['stop']->value['layover_time'];?>
</div>
                                        <div class="box size-all">

                                        <div class="t-p" style="width: 100%">
                                        <table>
                                        <tr>
                                        <td class="text-code center">
                                            <div class=""></div>
                                            <div class="bold"><?php echo $_smarty_tpl->tpl_vars['row']->value['data']['code'];?>
</div>
                                        </td>
                                        <td class="text-from left">
                                            <div><span class="bold"><?php echo $_smarty_tpl->tpl_vars['stop']->value['from_code'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['stop']->value['departure_time'];?>
</div>
                                            <div class="font-normal"><?php echo $_smarty_tpl->tpl_vars['stop']->value['from'];?>

                                            </div>
                                            <div class="t-p font-normal"><?php echo $_smarty_tpl->tpl_vars['stop']->value['departure'];?>
</div>
                                        </td>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                <?php }?>

                                <td class="text-to left">
                                    <div><span class="bold"><?php echo $_smarty_tpl->tpl_vars['flight']->value['to_code'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['flight']->value['arrival_time'];?>
</div>
                                    <div class="font-normal"><?php echo $_smarty_tpl->tpl_vars['flight']->value['to'];?>

                                    </div>
                                    <div class="t-p font-normal"><?php echo $_smarty_tpl->tpl_vars['flight']->value['arrival_date'];?>
</div>

                                </td>
                                <td style="width: auto;">
                                    <div class=""><?php echo $_smarty_tpl->tpl_vars['flight']->value['travel_time'];?>
</div>
                                    <div class=" l"><?php echo $_smarty_tpl->tpl_vars['flight']->value['class'];?>
</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['flight']->value['return']) {?>
                    RETURN
                    <br>
                    <div class="box size-all">
                        <div class="box2 t-p">
                            <table>
                                <tr>
                                    <td class="left rout-block  ">
                                        <div class="dest-title">
                                            <?php echo $_smarty_tpl->tpl_vars['flight']->value['from'];?>
 <?php echo $_smarty_tpl->tpl_vars['flight']->value['from_code'];?>
 -
                                            <?php echo $_smarty_tpl->tpl_vars['flight']->value['to'];?>
 <?php echo $_smarty_tpl->tpl_vars['flight']->value['to_code'];?>

                                        </div>
                                        <div class="dest-date  font-normal t-p">(<?php echo $_smarty_tpl->tpl_vars['flight']->value['departure'];?>
)</div>
                                    </td>
                                    <td style="width: auto;"><?php echo $_smarty_tpl->tpl_vars['flight']->value['departure'];?>
</td>
                                </tr>
                            </table>
                        </div>
                        <div class="t-p" style="width: 100%">
                            <table>
                                <tr>
                                    <td class="text-code center">
                                        <div class=""></div>
                                        <div class="bold"><?php echo $_smarty_tpl->tpl_vars['row']->value['data']['code'];?>
</div>
                                    </td>
                                    <td class="text-from left">
                                        <div>
                                            <span class="bold"><?php echo $_smarty_tpl->tpl_vars['flight']->value['return_from_code'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['flight']->value['return_departure_time'];?>

                                        </div>
                                        <div class="font-normal"><?php echo $_smarty_tpl->tpl_vars['flight']->value['return_from'];?>

                                        </div>
                                        <div class="t-p font-normal"><?php echo $_smarty_tpl->tpl_vars['flight']->value['return'];?>
</div>
                                    </td>
                <?php if ($_smarty_tpl->tpl_vars['flight']->value['stops_return']) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['flight']->value['stops_return'], 'stop', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['stop']->value) {
?>
                                    <td class="text-to left">
                                        <div>
                                            <span class="bold"><?php echo $_smarty_tpl->tpl_vars['stop']->value['return_to_code'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['stop']->value['return_arrival_time'];?>

                                        </div>
                                        <div class="font-normal"><?php echo $_smarty_tpl->tpl_vars['stop']->value['return_to'];?>

                                        </div>
                                        <div class="t-p font-normal"><?php echo $_smarty_tpl->tpl_vars['stop']->value['return_arrival_date'];?>
</div>

                                    </td>
                                    <td style="width: auto;">
                                        <div class=""><?php echo $_smarty_tpl->tpl_vars['stop']->value['return_travel_time'];?>
</div>
                                        <div class=" l"><?php echo $_smarty_tpl->tpl_vars['stop']->value['return_class'];?>
</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="center layover" > <?php echo $_smarty_tpl->tpl_vars['stop']->value['return_layover_time'];?>
</div>
                                    <div class="t-p" style="width: 100%">
                                        <table>
                                            <tr>
                                                <td class="text-code center">
                                                    <div class=""></div>
                                                    <div class="bold"><?php echo $_smarty_tpl->tpl_vars['row']->value['data']['code'];?>
</div>
                                                </td>
                                                <td class="text-from left">
                                                    <div>
                                                        <span class="bold"><?php echo $_smarty_tpl->tpl_vars['stop']->value['return_from_code'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['stop']->value['return_departure_time'];?>

                                                    </div>
                                                    <div class="font-normal"><?php echo $_smarty_tpl->tpl_vars['stop']->value['return_from'];?>

                                                    </div>
                                                    <div class="t-p font-normal"><?php echo $_smarty_tpl->tpl_vars['stop']->value['return'];?>
</div>
                                                </td>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                        <?php }?>

                                    <td class="text-to left">
                                        <div>
                                            <span class="bold"><?php echo $_smarty_tpl->tpl_vars['flight']->value['return_to_code'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['flight']->value['return_arrival_time'];?>

                                        </div>
                                        <div class="font-normal"><?php echo $_smarty_tpl->tpl_vars['flight']->value['return_to'];?>

                                        </div>
                                        <div class="t-p font-normal"><?php echo $_smarty_tpl->tpl_vars['flight']->value['return_arrival_date'];?>
</div>

                                    </td>
                                    <td style="width: auto;">
                                        <div class=""><?php echo $_smarty_tpl->tpl_vars['flight']->value['return_travel_time'];?>
</div>
                                        <div class=" l"><?php echo $_smarty_tpl->tpl_vars['flight']->value['return_class'];?>
</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php }?>


            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

    </div>
    <div class="text1 title">Did you know that booking with an affordable Ticket Protection will give you peace of mind
        if your plans
        change? I am here to help with travel planning, rent a car, save on hotel - free advice and 24/7 support
        included.
    </div>
    <div class="footer">
        <div>SINCERELY, JOE</div>
        <table>
            <tr>
                <td class="left t1">
                    <div>4118 14 Avenue suite 56</div>
                    <div class="t-p">4118 14 Avenue suite 56</div>

                </td>
                <td class="left t2">
                    <div class="green">Give us a call</div>
                    <div class="t-p">888-560-3025</div>
                </td>
                <td class="left t3">

                    <div class="green">Give us a call</div>
                    <div class="t-p">888-560-3025</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="center t-p">© 2017 Class&Luxury. All right reserved.</div>


</div>

</body>


</html>

<?php }
}
