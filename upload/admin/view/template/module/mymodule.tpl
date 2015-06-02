<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
     </div>
    <div class="content">
        
        <table class="list">
            <thead>
                <tr>
                    <td class="left">Торговая площадка</td>
                    <td class="right">Действие</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left">Prom.ua</td>
                    <td class="right">
                        <a onclick="location = '<?php echo $edit_prom; ?>'" class="button">
                            изменить
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="left">All.biz</td>
                    <td class="right">изменить</td>
                </tr>
                <tr>
                    <td class="left">Zakupka.com</td>
                    <td class="right">изменить</td>
                </tr>
            </tbody>
        </table>

    </div>
  </div>
</div>
<script type="text/javascript">
<?php echo $footer; ?>