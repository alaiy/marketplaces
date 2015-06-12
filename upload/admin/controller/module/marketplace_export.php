<?php
/*
 * This module is designed to selectively export goods to marketplaces.
 */
class ControllerModuleMarketplaceExport extends Controller {
	private $error = array(); 
        
        /*
         * This function initializes the module.
         */
	public function index() {   
            
                /*
                 * loading the necessary libraries or models
                 */
		$this->language->load('module/marketplace_export');
                $this->load->model('setting/setting');
                $this->load->model('design/layout');
                /*
                 * initialization language
                 */
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('marketplace_export', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
                /*
                 * checking errors
                 */
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                /*
                 * seting breadcrumbs
                 */
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/marketplace_export', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
                /*
                 * generating urls
                 */
		$this->data['action'] = $this->url->link('module/marketplace_export', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['edit_prom'] = $this->url->link('module/marketplace_export/edit', 'token=' . $this->session->data['token'] . '&platform=Prom.ua', 'SSL');
                $this->data['edit_allbiz'] = $this->url->link('module/marketplace_export/edit', 'token=' . $this->session->data['token'] . '&platform=allbiz', 'SSL');
                $this->data['edit_zakupka'] = $this->url->link('module/marketplace_export/edit', 'token=' . $this->session->data['token'] . '&platform=zakupka', 'SSL');
                
                $this->data['modules'] = array();
		if (isset($this->request->post['marketplace_export_module'])) {
			$this->data['modules'] = $this->request->post['marketplace_export_module'];
		} elseif ($this->config->get('marketplace_export_module')) { 
			$this->data['modules'] = $this->config->get('marketplace_export_module');
		}	
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/marketplace_export.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}
        /*
         * validating module
        */
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/marketplace_export')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
        /*
         * This function edit selected marketplaces.
         */
        public function edit()
        {
                /*
                 * loading the necessary libraries or models
                 */
                $this->language->load('module/marketplace_export');
                $this->load->model('catalog/category');
                $this->load->model('catalog/product');
                $this->load->model('design/layout');
		$this->document->setTitle($this->language->get('heading_title'));
                /*
                 * initialization language
                 */
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('marketplace_export', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
                /*
                 * checking errors
                 */
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                /*
                 * seting breadcrumbs
                 */
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/marketplace_export', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
                $this->data['breadcrumbs'][] = array(
			'text'      => $_GET['platform'],
			'href'      => $this->url->link('module/marketplace_export/edit', 'token=' . $this->session->data['token'] . '&platform=' . $_GET['platform'], 'SSL'),
			'separator' => ' :: '
		);
	                
		$this->data['modules'] = array();
		if (isset($this->request->post['marketplace_export_module'])) {
			$this->data['modules'] = $this->request->post['marketplace_export_module'];
		} elseif ($this->config->get('marketplace_export_module')) { 
			$this->data['modules'] = $this->config->get('marketplace_export_module');
		}
                
                /*
                 * geting list of all categories
                 */
                $this->data['category_list'] = $this->model_catalog_category->getCategories(0);
                /* 
                * $products = $this->model_catalog_product->getProducts(0);
                $productsId = array();
                foreach ($products as $oneProduct)
                { 
                    $productsId [] = $oneProduct['product_id'];
                }
                $this->data['uniqu_categors_id'] = array_unique($productsId);
                
                */
                /*
                 * seting token for ajax
                 */
                $this->data['token'] = $this->session->data['token'];


		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'marketplace_export/edit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
        }
        /*
         * This function get product's id, which are included in the selected categories.
         */
        public function getProductsForExport()
        {
            /*
             * POST data
             */
            $categorysIdString = $_POST['categors_id']; 
            $exportedProductToCatregor = $_POST['exported_products_id'];
            if($categorysIdString)
            {
                /*
                 * set an associative array "categories to products" from POST data
                 */
                $productsId = explode(",", $exportedProductToCatregor);
                if($productsId)
                {
                    foreach ($productsId as $oneProd)
                    {
                        $tmp = explode("-", $oneProd);
                        for($i = 1; $i < count($tmp); $i++)
                        {
                            $categorsToProd [$tmp[$i]][] = $tmp[0]; 
                        }
                    }
                }
                $categorysId = explode(",", $categorysIdString);

                $prodToCategors = array();
                if($categorysId)
                {
                    foreach ($categorysId as $oneCategorId)
                    { 
                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE  category_id = '" . $oneCategorId . "'");
                        if ($query->num_rows) {
                            foreach ($query->rows as $oneRow)
                            {
                                if(isset($categorsToProd[$oneCategorId]))
                                {
                                    if (!in_array($oneRow['product_id'], $categorsToProd[$oneCategorId]))
                                        $prodToCategors[$oneRow['product_id']][] = $oneCategorId;
                                }
                                else
                                {
                                    $prodToCategors[$oneRow['product_id']][] = $oneCategorId;
                                }
                            }
                        }	
                    }
                    if($prodToCategors)
                    {
                        $html = $this->generateHtmlForProducts($prodToCategors);
                        echo $html;  
                    }
                }
            }
        }
        
        public function updateProductsForExport()
        {
            $productsToCatregor = $_POST['products_id'];
            $exportedProductToCatregor = $_POST['exported_products_id'];
            $exportedProductsId = explode(",", $exportedProductToCatregor);
            $productsId = explode(",", $productsToCatregor);
            $prodToCategors = array();
            if($exportedProductsId)
            {
                foreach ($exportedProductsId as $oneProd)
                {
                    $tmp = explode("-", $oneProd);
                    for($i = 1; $i < count($tmp); $i++)
                    {
                        $prodToCategorsExported[$tmp[0]][] = $tmp[$i]; 
                    }

                }
            }
            if($productsId)
            {
                foreach ($productsId as $oneProd)
                {
                    $tmp = explode("-", $oneProd);
                    for($i = 1; $i < count($tmp); $i++)
                    {
                        if(isset($prodToCategorsExported[$tmp[0]]))
                        {
                            if(!in_array($tmp[$i],$prodToCategorsExported[$tmp[0]]))
                            {
                                $prodToCategors[$tmp[0]][] = $tmp[$i]; 
                            }
                        }
                        else
                        {
                            $prodToCategors[$tmp[0]][] = $tmp[$i];
                        }
                    }

                }
            }
            if($prodToCategors)
            {
                $html = $this->generateHtmlForProducts($prodToCategors);
                echo $html;     
            }
        }
        
        public function generateHtmlForProducts($prodToCategors)
        {
            $this->load->model('catalog/product');
            $uniqueProductsId = array_keys($prodToCategors);
            $html = "<table class='table-products'>
                        <thead>
                            <tr>
                                <td></td>
                                <td>Фото</td>
                                <td>Название</td>
                            </tr>
                        </thead>
                    <tbody>";
            $i = -1;
            if($uniqueProductsId)
            {
                foreach ($uniqueProductsId as $oneUniqueProductId)
                {
                    $categorsString = implode("-",$prodToCategors[$oneUniqueProductId]);
                    $i ++;
                    $products = $this->model_catalog_product->getProduct((int)$oneUniqueProductId);
                    $html.= "<tr id='tr_product_".$i ."'><td class='check-td'><input class='product-check' type='checkbox' id='product_".$i ."' value=".$products['product_id']."-".$categorsString."></td><td class='img-td'><img class='img-product' src='". HTTP_CATALOG . "/image/" .$products['image']."'></td><td>".$products['name']."</td></tr>";

                }

                $html.= "</tbody></table>";
                return $html;
            }
        }
        
        public function getExport()
        {
            $this->load->model('catalog/product');
            $this->load->model('catalog/category');
            $productsIdString = $_POST['categors_id'];
            $exportedProductToCatregor = $_POST['exported_products_id'];
            
            $exportedProductsId = explode(",", $exportedProductToCatregor);
            $productsId = explode(",", $productsIdString);
            $categorsToProd = array();
            if($productsId)
            {
                foreach ($productsId as $oneProd)
                {
                    $tmp = explode("-", $oneProd);
                    for($i = 1; $i < count($tmp); $i++)
                    {
                        $categorsToProd [$tmp[$i]][] = $tmp[0]; 
                    }

                }
            }
            if($exportedProductsId)
            {
                foreach ($exportedProductsId as $oneProd)
                {
                    $tmp = explode("-", $oneProd);
                    for($i = 1; $i < count($tmp); $i++)
                    {
                        if(isset($categorsToProd[$tmp[$i]]))
                        {
                            if(!in_array($tmp[0],$categorsToProd[$tmp[$i]]))
                            {
                                $categorsToProd [$tmp[$i]][] = $tmp[0];  
                            }
                        }
                        else
                        {
                            $categorsToProd [$tmp[$i]][] = $tmp[0]; 
                        } 
                    }

                }
            /* v1.0
                if($categorsToProd)
                {
                    $uniqueCategorsId = array_keys($categorsToProd);
                    $html = "<table class='table-exports'><tbody>";
                    $i = -1;
                    $j = -1;
                    foreach ($uniqueCategorsId as $oneUniqueId)
                    {
                        $j ++;
                        $categors_info = $this->model_catalog_category->getCategory($oneUniqueId);
                        if($categors_info)
                        {
                            $from = $i+1;
                            $to = $i+count($categorsToProd[$oneUniqueId])+1;
                            $fromTo = $from . "" . $to;
                            $html.= "<tr class='tr-category'><td><button onclick='displayExport(".$from.",".$to.")'>_</button></td><td colspan='2'>Категория: ".$categors_info['name']."<td>";
                            foreach ($categorsToProd[$oneUniqueId] as $oneProductId)
                            {   
                                $i ++;
                                $products = $this->model_catalog_product->getProduct($oneProductId);
                                $html.= "<tr class='tr-product' id='tr_export_".$i ."'><td><input class='export-check' type='checkbox' id='export_".$i ."' value=".$products['product_id']."-".$oneUniqueId."></td><td><img src='http://localhost/opencart/upload/image/".$products['image']."' width='50' height='50'></td><td>".$products['name']."</td></tr>";
                            }
                        }

                    }
                    $html.= "</tbody></table>";
                    echo $html;  
                }
             * 
             */
                if($categorsToProd)
                {
                    $categories = $this->model_catalog_category->getCategories(0);
                    foreach ($categories as $oneCategory)
                    {
                        $categoriesId [] = $oneCategory['category_id'];
                    }
                    $uniqueCategorsId = array_keys($categorsToProd);
                    $html = "<table class='table-exports'><tbody>";
                    $i = -1;
                    $j = -1;
                    foreach ($categoriesId as $oneUniqueId)
                    {
                        $j ++;
                        $categors_info = $this->model_catalog_category->getCategory($oneUniqueId);
                        if($categors_info)
                        {
                            if(isset($categorsToProd[$oneUniqueId]))
                            {
                            $from = $i+1;
                            $to = $i+count($categorsToProd[$oneUniqueId])+1;
                            $fromTo = $from . "" . $to;
                            $html.= "<tr class='tr-category'><td><button onclick='displayExport(".$from.",".$to.")'>_</button></td><td colspan='2'>Категория: ".$categors_info['name']."</td></tr>";
                            
                                foreach ($categorsToProd[$oneUniqueId] as $oneProductId)
                                {   
                                    $i ++;
                                    $products = $this->model_catalog_product->getProduct($oneProductId);
                                    $html.= "<tr class='tr-product' id='tr_export_".$i ."'><td><input class='export-check' type='checkbox' id='export_".$i ."' value=".$products['product_id']."-".$oneUniqueId."></td><td><img src='". HTTP_CATALOG . "/image/" .$products['image']."' width='50' height='50'></td><td>".$products['name']."</td></tr>";
                                }
                            }
                            else
                            {
                                $html.= "<tr class='tr-category'><td><button>_</button></td><td colspan='2'>Категория: ".$categors_info['name']."</td></tr>";
                            
                            }

                        }

                    }
                    $html.= "</tbody></table>";
                    echo $html;  
                }
            }
        }

        public function saveExport()
        {
            $this->load->model('catalog/product');
            $this->load->model('catalog/category');
            $this->load->model('catalog/manufacturer');
            $reg = array("/&quot;/","/&laquo;/", "/&raquo;/", "/&ndash;/", "/&hellip;/", "/&nbsp;/", "/&amp;/", "/&nbsp;/", "/&lt;/", "/&gt;/");
            $replace = array('"','«','»', '—', '..',' ','&', ' ','<','>');
    
            $productsIdString = $_POST['products_id'];
            $countToExport = 2;
            $productsId = explode(",", $productsIdString);
            if ($productsId) {
                foreach ($productsId as $oneProd)
                {
                    $tmp = explode("-", $oneProd);
                    for($i = 1; $i < count($tmp); $i++)
                    {
                        $prodToCategors[$tmp[0]][] = $tmp[$i];
                    }

                }
            }
            if(isset($prodToCategors))
            {
                 // we use the PHPExcel package from http://phpexcel.codeplex.com/
                $cwd = getcwd();
                chdir( DIR_SYSTEM.'PHPExcel' );
                require_once( 'Classes/PHPExcel.php' );
                require_once( 'Classes/PHPExcel/IOFactory.php' );
                chdir( $cwd );
                $aLetters = array(
                    'Z',
                    'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
                    'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ',
                    'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ',
                    'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ',
                );
                // set appropriate timeout limit
                ini_set("memory_limit","256M");
                set_time_limit( 1800 );

                // create a new workbook
                $excel2 = PHPExcel_IOFactory::createReader('Excel5');
                $excel2 = $excel2->load('template.xls'); // Empty Sheet
                $categoriesToExel = array();

                $uniqueProductsId = array_keys($prodToCategors); 
                foreach ($uniqueProductsId as $oneProductId)
                {   
                    
                    foreach($prodToCategors[$oneProductId] as $oneCategory)
                    {
                                              
                        $array_to_exel = array();
                        $products = $this->model_catalog_product->getProduct($oneProductId);
                        $array_to_exel ['product_id'] = $products['product_id']."-".$oneCategory;
                        $name = preg_replace('/&lt;[^&]*[^g]*[^t]*[^;]*./', '',  $products['name']);
                        $array_to_exel ['name'] = preg_replace($reg, $replace, $name);
                        $array_to_exel ['tag'] = $products['tag'];                        
                        $description = trim(preg_replace('/&lt;[^&]*[^g]*[^t]*[^;]*./', '', $products['description']));
                        $array_to_exel ['description'] = preg_replace($reg, $replace, $description);;
                        $array_to_exel ['price'] = $products['price'];
                        $array_to_exel ['minimum_quantity'] = $products['minimum'];
                        $array_to_exel ['image'][] = HTTP_CATALOG . "/image/" .$products['image'];
                        $product_images = $this->model_catalog_product->getProductImages($products['product_id']);
                        if($product_images)
                        {
                            foreach ($product_images as $oneImg)
                            {
                               $array_to_exel ['image'][] = HTTP_CATALOG . "/image/" .$oneImg['image'];
                            }
                        }

                        if($products['quantity']>$products['minimum'])
                        {
                            $array_to_exel ['quantity'] = "+";
                        }
                        else 
                        {
                            $array_to_exel ['quantity'] = "-";
                        }
                        $manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($products['manufacturer_id']);
                        if($manufacturer_info)
                            $array_to_exel ['manufacturer'] = $manufacturer_info['name'];
                        else
                            $array_to_exel ['manufacturer'] = '';
                        $array_to_exel ['category_id'] = $oneCategory;
                        $categors_info = $this->model_catalog_category->getCategory($oneCategory);
                        $categoriesToExel ['id'][] = $oneCategory;
                        //$categoriesToExel ['pid'][] = $categors_info['parent_id'];
                        $catName = $categors_info['name'];
                        $categoriesToExel ['name'][] = preg_replace($reg, $replace, $catName);

                        //$categoriesToExel ['pinn'][] = $oneCategory."#group_key#".$categors_info['name'];
                        $array_to_exel ['category_name'] = preg_replace($reg, $replace, $catName);
                        $prodInn = $products['product_id']."#".$oneCategory."#product_key#".$products['name'];
                        $categoryInn = $oneCategory."#group_key#".$categors_info['name'];
                        $array_to_exel ['product_inn'] =  preg_replace($reg, $replace, $prodInn);
                        $array_to_exel ['category_inn'] =  preg_replace($reg, $replace, $categoryInn);
                        $categoriesToExel ['inn'][] =  preg_replace($reg, $replace, $categoryInn);
                        $product_specials = $this->model_catalog_product->getProductSpecials($products['product_id']);
                        $prod_spec_id = array();
                        $priorityTmp = 9999;
                        $priceTmp = 0;
                        if($product_specials)
                        {
                            foreach ($product_specials as $one_product_spec)
                            {
                                
                                if($one_product_spec['customer_group_id'] == 1)
                                {
                                    $rCheckDate = new datetime('now');
                                    $rPeriodFrom = new datetime($one_product_spec['date_start']);
                                    $rPeriodTo = new datetime($one_product_spec['date_end']);
                                    
                                    if ($rPeriodFrom <= $rCheckDate and $rCheckDate <= $rPeriodTo)
                                    {
                                        if($one_product_spec['priority'] < $priorityTmp)
                                        {
                                            $priorityTmp = $one_product_spec['priority'];
                                            $priceTmp = $one_product_spec['price'];
                                            $array_to_exel ['specials'] = 100-($priceTmp*100/$products['price'])."%";
                                        }
                                    }
                                }

                            }
                        }
                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE setting.key = 'config_currency' AND setting.store_id = 0");
                        $array_to_exel ['currency'] = $query->row['value'];
                        $namesAttr = array();
                        $valueAttr = array();
                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute "
                                . "LEFT JOIN " . DB_PREFIX . "attribute_description "
                                . "ON product_attribute.attribute_id=attribute_description.attribute_id "
                                . "WHERE product_attribute.product_id = '".$products['product_id']."'");

                        if ($query->num_rows) {
                            foreach ($query->rows as $oneRow)
                            {
                                $array_to_exel ['attr_name'] [] = $oneRow['name'];
                                $array_to_exel ['attr_text'] [] = $oneRow['text'];
                            }
                        }
                       
                        $excel2->setActiveSheetIndex(0);

                        $excel2->getActiveSheet()->setCellValue('A'.$countToExport, $array_to_exel ['product_id'])
                            ->setCellValue('B'.$countToExport, $array_to_exel ['name'])
                            ->setCellValue('C'.$countToExport, $array_to_exel ['tag'])       
                            ->setCellValue('D'.$countToExport, $array_to_exel ['description'])
                            ->setCellValue('F'.$countToExport, $array_to_exel ['price'])
                            ->setCellValue('G'.$countToExport, $array_to_exel ['currency'])
                            ->setCellValue('H'.$countToExport, 'шт.')
                            ->setCellValue('I'.$countToExport, $array_to_exel ['minimum_quantity'])
                            ->setCellValue('L'.$countToExport, implode(',',$array_to_exel ['image']))
                            ->setCellValue('M'.$countToExport, $array_to_exel ['quantity'])
                            ->setCellValue('O'.$countToExport, $array_to_exel ['manufacturer'])
                            ->setCellValue('Q'.$countToExport, $array_to_exel ['category_id'])
                            ->setCellValue('V'.$countToExport, $array_to_exel ['product_inn'])
                            ->setCellValue('Y'.$countToExport, $array_to_exel ['category_inn']);
                        if(isset($array_to_exel ['specials']))
                        {
                            $excel2->getActiveSheet()->setCellValue('N'.$countToExport, $array_to_exel ['specials']);
                        }
                        else 
                        {
                            $excel2->getActiveSheet()->setCellValue('N'.$countToExport, '');
                        }
                        
                        if(isset($array_to_exel ['attr_name']))
                        {
                            $countAttr = count($array_to_exel ['attr_name']);
                            if($countAttr > 30)
                            {
                                $countAttr = 30;
                            }
                            for($m = 0; $m < $countAttr; $m++)
                            {
                                  $excel2->getActiveSheet()->setCellValue($aLetters[$m*3].$countToExport, $array_to_exel ['attr_name'][$m])
                                                           ->setCellValue($aLetters[$m*3+2].$countToExport, $array_to_exel ['attr_text'][$m]);
                            }
                        }
                        $countToExport ++;

                    } 
                }
                
                $keys = array_keys(array_unique($categoriesToExel ['id']));
                $l = 2;
                foreach ($keys as $oneKey)
                {
                    $excel2->setActiveSheetIndex(1);
                    $excel2->getActiveSheet()->setCellValue('A'.$l, $categoriesToExel ['id'][$oneKey])
                            ->setCellValue('B'.$l, $categoriesToExel ['name'][$oneKey])
                            ->setCellValue('C'.$l, $categoriesToExel ['inn'][$oneKey]);
                    $l ++;

                }

                $objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel5');
                $objWriter->save('export_to_prom.xls');
                $file = 'export_to_prom.xls';
                //$this->file_force_download($file);
                echo  preg_replace($reg, $replace, $this->url->link('module/marketplace_export/file_force_download', 'token=' . $this->session->data['token'] . '&file=' . $file, 'SSL'));

            }
            //var_dump($prodToCategors);die;
        }
        public function file_force_download() {
            $file = $_GET['file']; 
            if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
              ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            if ($fd = fopen($file, 'rb')) {
              while (!feof($fd)) {
                print fread($fd, 1024);
              }
              fclose($fd);
            }
            exit;
          }
        }
}
?>
