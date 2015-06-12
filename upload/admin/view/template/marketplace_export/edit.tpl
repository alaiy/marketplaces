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

                <p class="red-msg">!!! Обратите внимание !!!  Если категория на сайте была изменена хоть на один символ, то при экспорте на торговую площадку будет создана новая категория</p>
                <br>
                <p class="green-msg">Выберите категории, которые нужно экспортировать. Если категории не выбраны - экспорт категории не выполняеться</p>
                <br>
                <p>Окно № 1 : Выбор категорий для экспорта</p>
                <br>
                <a onclick="displayAll('.category-check');countCheckedCategors();">Выделить все</a> / <a onclick="skipAll('.category-check');countCheckedCategors();">Снять все</a> <br><br>    
                <span class="red-span">всего выделено <span class="count-selected-categors"></span> категорий </span><button onclick="showProducts()">Добавить в экспорт</button> 
                <div class="categor">
                    
                        <?php 
                        $i = -1;
                        foreach($category_list as $one_categor)
                        {
                            $i++;
                            if($i%2==0) { 
                                echo "<p class='even-p'>";
                            }
                            else
                            {
                                echo "<p class='odd-p'>";
                            }

                            ?>
                            <input class="category-check" type="checkbox" id=<?php echo "category_".$i; ?> value=<?php echo $one_categor['category_id']; ?>><?php echo $one_categor['name']; ?><Br>
                           </p> <?
                        }
                        ?>
                    
                </div>

            </div>
            <div class="div-right-one">
                <div class="button down-button"><button onclick="saveExport()">Получить экспортный файл</button></div>
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
                <p class="red-msg bot">!!! Обратите внимание !!!  Если товар на сайте был изменен хоть на один символ, то при экспорте на торговую площадку будет создан новый товар</p>
                <br>
                <p class="green-msg bot">Выберите товары, которые нужно экспортировать. Если товары не выбраны - экспорт товаров не выполняеться</p>
                <p>Окно № 2 : Выбор товаров для экспорта</p>
                <a onclick="displayAll('.product-check');countCheckedProducts();">Выделить все</a> / <a onclick="skipAll('.product-check');countCheckedProducts();">Снять все</a> <br><br>                
                    <span class="red-span">всего выделено <span class="count-selected-products"></span> товаров </span>
                    <div class="product">
                        
                    </div>    
                <div class="div-button-centre"><button onclick="showExport(0);">>></button> </div>
            </div>
            
            <div class="div-right">
                <p>Шаг 3: Проверьте список  товаров и категорий для экспорта.</p>
                <br><br><br><br><br>
                <p>Окно № 3 : Выбранные товары и категории для экспорта</p>
                <a onclick="displayAll('.export-check');countCheckedExports();">Выделить все</a> / <a onclick="skipAll('.export-check');countCheckedExports();">Снять все</a> <br><br>
                    <span class="red-span">всего выделено <span class="count-selected-exports"></span> товаров </span><button onclick="deleteFromExport();countCheckedProducts();">Удалить</button> 
                    <div class="export">
                        
                    </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="button down-button"><button onclick="saveExport()">Получить экспортный файл</button></div>
    </div>    

   
  </div>
</div>

<script type="text/javascript">
    $(document).on("click", "a.fileDownloadSimpleRichExperience", function () {
    $.fileDownload($(this).prop('href'), {
        preparingMessageHtml: "We are preparing your report, please wait...",
        failMessageHtml: "There was a problem generating your report, please try again."
    });
    return false; //this is critical to stop the click event which will trigger a normal file download!
});
function showProducts() {

    var count_catagors = $("input.category-check").length;
    var i = 0;
    var categors_id = [];
    if(count_catagors > 0)
    {
        for(i; i<count_catagors; i++)
        {
           if(document.getElementById('category_'+i).checked) {
               categors_id.push(document.getElementById('category_'+i).value);
           }
        }
        /*
        if(categors_id.length == 0)
        {
            alert("Выберите хотя бы одну категорию.");  
            return;
        }
        */
   }
    var count_exported_products = $("input.export-check").length;
    i = 0;
    var exported_products_id = [];
    if(count_exported_products > 0)
    {
        for(i; i<count_exported_products; i++)
        {
            exported_products_id.push(document.getElementById('export_'+i).value);
        }
    }
    $.ajax({
        type: 'POST',
        url: 'index.php?route=module/marketplace_export/getProductsForExport&token=<?php echo $token;?>',
        data: 'categors_id=' + categors_id +'&exported_products_id=' + exported_products_id,
        success: function(data){
            $('.product').html(data);
            countCheckedProducts();
        }
    });
    
}
function updateProduct() {
    var update_count_products = $("input.product-check").length;
    var update_i = 0;
    var update_products_id = [];
    if(update_count_products > 0)
    {    
        for(update_i; update_i<update_count_products; update_i++)
        {
            update_products_id.push(document.getElementById('product_'+update_i).value);
        }
    }
    
    var update_count_exported_products = $("input.export-check").length;
    update_i = 0;
    var update_exported_products_id = [];
    if(update_count_exported_products > 0)
    { 
        for(update_i; update_i<update_count_exported_products; update_i++)
        {
            update_exported_products_id.push(document.getElementById('export_'+update_i).value);
        }
    }
    $.ajax({
        type: 'POST',
        url: 'index.php?route=module/marketplace_export/updateProductsForExport&token=<?php echo $token;?>',
        data: 'products_id=' + update_products_id +'&exported_products_id=' + update_exported_products_id,
        success: function(data){
            $('.product').html(data);
        }
    });
    
}

function removeElement(element) {
    element && element.parentNode && element.parentNode.removeChild(element);
}

function showExport(count_deleted) {

    var count_products = $("input.product-check").length;
    var i = 0;
    var products_id = [];
    if(count_products > 0)
    {
        for(i; i<count_products; i++)
        {
           if(document.getElementById('product_'+i).checked) {          
               products_id.push(document.getElementById('product_'+i).value);
           }
        }
        /*
        if(products_id.length == 0)
        {
            alert("Выберите хотя бы один товар.");  
            return;
        }
        */
    }
    var count_exported_products = $("input.export-check").length + count_deleted;
    i = 0;
    var exported_products_id = [];
    if(count_exported_products > 0)
    {
        for(i; i<count_exported_products; i++)
        {
            if(document.getElementById('export_'+i) != null)
            {
                exported_products_id.push(document.getElementById('export_'+i).value);
            }
        }
    }
    $.ajax({
        type: 'POST',
        url: 'index.php?route=module/marketplace_export/getExport&token=<?php echo $token;?>',
        data: 'categors_id=' +  products_id +'&exported_products_id=' + exported_products_id,
        success: function(data){

            $('.export').html(data);
            updateProduct();
            skipExport();
            countCheckedProducts();
            
        }
    });
   
}

function deleteFromExport() {
    var count_products = $("input.export-check").length;
    var i = 0;
    var count_deleted = 0;
    if(count_products > 0)
    {
        for(i; i<count_products; i++)
        {
           if(document.getElementById('export_'+i).checked) {
               removeElement(document.getElementById('export_'+i));
               count_deleted ++;
           }
        }
        showExport(count_deleted);
        skipExport();
        countCheckedExports();
    }           
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

function displayExport(from,to) {

    
    var elements = document.getElementsByClassName("tr-product");
    for(var i = from; i < to; i++) {
       if( elements[i].style.display == 'none'){
          elements[i].style.display = 'table-row';
       }
       else
       {
           elements[i].style.display = 'none';
       }
    }
}
function skipExport() {
    var elements = document.getElementsByClassName("tr-product");
    for(var i = 0, length = elements.length; i < length; i++) {
           elements[i].style.display = 'none';
    }
}
function saveExport() {
    var elements = document.getElementsByClassName("export-check");
    var products_id = [];
    for(var i = 0, length = elements.length; i < length; i++) {
           products_id.push(elements[i].value);
    }
    if(products_id.length == 0)
    {
        alert("Выберите хотя бы один товар!");
    }
    else
    {
        $.ajax({
            type: 'POST',
            url: 'index.php?route=module/marketplace_export/saveExport&token=<?php echo $token;?>',
            data: 'products_id=' +  products_id,
            success: function(data){
                window.location = data;
            }
        });
    }
}
function getExportFile(href) {
    console.log(href);
    href = 'http://localhost/FileDownload/DownloadReport/4';
    $.fileDownload($(this).prop(href), {
        preparingMessageHtml: "We are preparing your report, please wait...",
        failMessageHtml: "There was a problem generating your report, please try again."
    });
    return false; //this is critical to stop the click event which will trigger a normal file download!
}
var countCheckedCategors = function() {
    var count_catagors = $("input.category-check").length;
    var i = 0;
    var categors = 0;
    if(count_catagors > 0)
    {
        for(i; i<count_catagors; i++)
        {
           if(document.getElementById('category_'+i).checked) {
               categors++;
           }
        }
    }
    $ (".count-selected-categors").html(categors);

};
var countCheckedProducts = function() {
    var count_catagors = $("input.product-check").length;
    var i = 0;
    var categors = 0;
    if(count_catagors > 0)
    {
        for(i; i<count_catagors; i++)
        {
           if(document.getElementById('product_'+i).checked) {
               categors++;
           }
        }
    }
    $ (".count-selected-products").html(categors);

};
var countCheckedExports = function() {
    var count_catagors = $("input.export-check").length;
    var i = 0;
    var categors = 0;
    if(count_catagors > 0)
    {
        for(i; i<count_catagors; i++)
        {
           if(document.getElementById('export_'+i).checked) {
               categors++;
           }
        }
    }
    $ (".count-selected-exports").html(categors);

};
$( ".categor input" ).on( "click", countCheckedCategors );
$( ".product" ).on( "click", countCheckedProducts );
$( ".export" ).on( "click", countCheckedExports );
countCheckedCategors();
countCheckedProducts();
countCheckedExports();


</script>
<?php echo $footer; ?>