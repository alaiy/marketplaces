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
                <button>Выделить все</button> / <button>Снять все</button> <br><br>
                <form method="post" action="#">
                    <span>всего выделено 5 категорий </span><input type="submit" value="Добавить в экспорт">
                    <div class="categor">
                            <p><input type="checkbox" name="option1" value="a1" checked>Windows 95/98<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>

                            <input type="checkbox" name="option5" value="a5">X3-DOS</p>

                    </div>
                </form>

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
                <button>Выделить все</button> / <button>Снять все</button> <br><br>
                <form method="post" action="#">
                    <span>всего выделено 5 категорий </span><input type="submit" value="Добавить в экспорт">
                    <div class="categor">
                            <p><input type="checkbox" name="option1" value="a1" checked>Windows 95/98<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>

                            <input type="checkbox" name="option5" value="a5">X3-DOS</p>

                    </div>
                </form>
            </div>
            <div class="div-right">
                <p>Шаг 3: Проверьте список  товаров и категорий для экспорта.</p>
                <p>Окно № 3 : Выбранные товары и категории для экспорта</p>
                <button>Выделить все</button> / <button>Снять все</button> <br><br>
                <form method="post" action="#">
                    <span>всего выделено 5 категорий </span><input type="submit" value="Добавить в экспорт">
                    <div class="categor">
                            <p><input type="checkbox" name="option1" value="a1" checked>Windows 95/98<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>
                            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
                            <input type="checkbox" name="option3" value="a3">System X<Br> 
                            <input type="checkbox" name="option4" value="a4">Linux<Br>

                            <input type="checkbox" name="option5" value="a5">X3-DOS</p>

                    </div>
                </form>
            </div>
        </div>
        <div class="clear"></div>
        <div class="button down-button"><button>Получить экспортный файл</button></div>
        
    </div>    

   
  </div>
</div>

<?php echo $footer; ?>