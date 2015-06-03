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
    <div class="my-content">
        <div class="top-box">
            <div class="div-left">
                <p>Шаг 1:  Выберите категориии товаров для экспорта.</p>
                <p>Окно № 1 : Выбор категорий для экспорта</p>
                <button onclick="displayAll('.category-check')">Выделить все</button> / <button onclick="skipAll('.category-check')">Снять все</button> <br><br>    
                <span>всего выделено 5 категорий </span><button onclick="showProducts()">Добавить в экспорт</button> 
                <div class="categor">
                    <p>
                        <?php 
                        $i = -1;
                        foreach($category_list as $one_categor)
                        {
                            $i++;
                            ?>
                            <input class="category-check" type="checkbox" id=<?php echo "category_".$i; ?> value=<?php echo $one_categor['category_id']; ?>><?php echo $one_categor['name']; ?><Br>
                            <?
                        }
                        ?>
                    </p>
                </div>

            </div>
            <div class="div-right-one">
                <div class="button down-button"><button>Получить экспортный файл</button></div>
                <div class="param-export">
                    <p>Поля которые обновляются при экспорте:</p>
                    <p>1. Код товара.</p>
                    <p>2. Название товара.</p>
                    <p>3. Ключевые слова.</p>
                    <p>4. Описание товара.</p>
                    <p>5. Цена.</p>
                    <p>6. Валюта.</p>
                    <p>7. Ед. измерения.</p>
                    <p>8. Минимальный заказ.</p>
                    <p>9. Изображение.</p>
                    <p>10. Наличие товара.</p>
                    <p>11. Скидка.</p>
                    <p>12. Производитель.</p>
                    <p>13. Код группы (на opencart).</p>
                    <p>14. Название группы.</p>
                    <p>15. Идентификационный код товара (на prom).</p>
                    <p>16. Идентификационный код группы на prom.</p>
                    <p>+ Харатеристики:</p>
                    <p>17. Название характеристики.</p>
                    <p>18. Измерение характеристики.</p>
                    <p>19. Значение характеристики.</p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="down-box">
            <div class="div-left">
                <p>Шаг 2:  Выберите товары для экспорта.</p>
                <p>Окно № 2 : Выбор товаров для экспорта</p>
                <button onclick="displayAll('.product-check')">Выделить все</button> / <button onclick="skipAll('.product-check')">Снять все</button> <br><br>                
                    <span>всего выделено 5 категорий </span><button onclick="showExport()">Добавить в экспорт</button> 
                    <div class="product_show">
                        
                    </div>               
            </div>
            <div class="div-right">
                <p>Шаг 3: Проверьте список  товаров и категорий для экспорта.</p>
                <p>Окно № 3 : Выбранные товары и категории для экспорта</p>
                <button onclick="displayAll('.export-check')">Выделить все</button> / <button onclick="skipAll('.export-check')">Снять все</button> <br><br>
                    <span>всего выделено 5 категорий </span><button onclick="">Добавить в экспорт</button> 
                    <div class="export_show">
                        
                    </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="button down-button"><button>Получить экспортный файл</button></div>
        
    </div>    

   
  </div>
</div>
<script type="text/javascript">
function showProducts() {

    var count_catagors = $("input.category-check").length;
    var i = 0;
    var categors_id = [];

    for(i; i<count_catagors; i++)
    {
       if(document.getElementById('category_'+i).checked) {
           categors_id.push(document.getElementById('category_'+i).value);
       }
    }
    $.ajax({
        type: 'POST',
        url: 'index.php?route=module/mymodule/getProductsForExport&token=<?php echo $token;?>',
        data: 'categors_id=' +  categors_id,
        success: function(data){
            
            $('.product_show').html(data);
        }
    });
}
function showExport() {

    var count_products = $("input.product-check").length;
    var i = 0;
    var products_id = [];


    for(i; i<count_products; i++)
    {
       if(document.getElementById('product_'+i).checked) {

           products_id.push(document.getElementById('product_'+i).value);
       }
    }

    $.ajax({
        type: 'POST',
        url: 'index.php?route=module/mymodule/getExport&token=<?php echo $token;?>',
        data: 'categors_id=' +  products_id,
        success: function(data){
            
            $('.export_show').append(data);
        }
    });
}
function skipAll(calss_name) {
    $(calss_name).each(function() { 
        this.checked = false;                     
    });         
}
function displayAll(calss_name) {
    $(calss_name).each(function() { 
        this.checked = true;              
    });
}
</script>
<?php echo $footer; ?>