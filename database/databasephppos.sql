CREATE DATABASE  IF NOT EXISTS `phppos25` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `phppos25`;
-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: phppos25
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `phppos_access`
--

DROP TABLE IF EXISTS `phppos_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `all_access` tinyint(1) NOT NULL DEFAULT 0,
  `controller` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `controller` (`controller`),
  KEY `phppos_access_key_fk` (`key`),
  CONSTRAINT `phppos_access_key_fk` FOREIGN KEY (`key`) REFERENCES `phppos_keys` (`key`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_access`
--

LOCK TABLES `phppos_access` WRITE;
/*!40000 ALTER TABLE `phppos_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_additional_item_numbers`
--

DROP TABLE IF EXISTS `phppos_additional_item_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_additional_item_numbers` (
  `item_id` int(11) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_variation_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`,`item_number`),
  UNIQUE KEY `item_number` (`item_number`),
  KEY `phppos_additional_item_numbers_ibfk_2` (`item_variation_id`),
  KEY `phppos_additional_item_numbers_ibfk_3` (`supplier_id`),
  CONSTRAINT `phppos_additional_item_numbers_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_additional_item_numbers_ibfk_2` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_additional_item_numbers_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_additional_item_numbers`
--

LOCK TABLES `phppos_additional_item_numbers` WRITE;
/*!40000 ALTER TABLE `phppos_additional_item_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_additional_item_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_app_config`
--

DROP TABLE IF EXISTS `phppos_app_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_app_config` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_app_config`
--

LOCK TABLES `phppos_app_config` WRITE;
/*!40000 ALTER TABLE `phppos_app_config` DISABLE KEYS */;
INSERT INTO `phppos_app_config` VALUES ('add_ck_editor_to_item','0'),('additional_appointment_note',''),('additional_payment_types',''),('allow_drag_drop_recv','0'),('allow_drag_drop_sale','0'),('allow_employees_to_use_2fa','0'),('allow_reorder_receiving_receipt','0'),('allow_reorder_sales_receipt','0'),('allow_scan_of_customer_into_item_field','0'),('always_minimize_menu','1'),('always_print_duplicate_receipt_all','0'),('always_put_last_added_item_on_top_of_cart','0'),('always_show_item_grid','0'),('always_use_average_cost_method','0'),('amount_of_cash_to_be_left_in_drawer_at_closing',''),('announcement_special',''),('auto_capture_signature','0'),('auto_focus_on_item_after_sale_and_receiving','0'),('auto_sync_offline_sales','0'),('automatically_email_invoice','0'),('automatically_email_receipt','0'),('automatically_print_duplicate_receipt_for_cc_transactions','0'),('automatically_show_comments_on_receipt','0'),('automatically_sms_receipt','0'),('averaging_method','moving_average'),('barcode_price_include_tax','0'),('calculate_average_cost_price_from_receivings','0'),('calculate_profit_for_giftcard_when',''),('capture_internal_notes_during_receiving','0'),('capture_internal_notes_during_sale','0'),('capture_sig_for_all_payments','0'),('cash_alert_high',''),('cash_alert_low',''),('change_sale_date_for_new_sale','0'),('change_sale_date_when_completing_suspended_sale','0'),('change_sale_date_when_suspending','0'),('change_to_recv_when_unsuspending_po','0'),('change_work_order_status_from_sales','0'),('charge_tax_on_recv','0'),('collapse_recv_ui_by_default','0'),('collapse_sales_ui_by_default','0'),('commission_default_rate','0'),('commission_percent_type','selling_price'),('company','MarcketFree'),('confirm_error_adding_item','0'),('create_invoices_for_customer_store_account_charges','0'),('create_invoices_for_supplier_store_account_charges','0'),('create_work_order_for_customer','0'),('create_work_order_is_checked_by_default_for_sale','0'),('crlf','\r\n'),('currency_code',''),('currency_symbol','Bs'),('currency_symbol_location','before'),('customer_allow_partial_match','0'),('customers_store_accounts','0'),('damaged_reasons',''),('dark_mode','0'),('date_format','middle_endian'),('decimal_point','.'),('default_age_to_verify',''),('default_credit_limit',''),('default_days_to_expire_when_creating_items',''),('default_employee_for_deliveries',''),('default_new_customer_to_current_location','0'),('default_new_items_to_service','0'),('default_payment_type','Efectivo'),('default_payment_type_recv','Efectivo'),('default_reorder_level_when_creating_items',''),('default_sales_person','logged_in_employee'),('default_tax_1_name','Sales Tax'),('default_tax_1_rate',''),('default_tax_2_cumulative','0'),('default_tax_2_name','Sales Tax 2'),('default_tax_2_rate',''),('default_tax_3_name',''),('default_tax_3_rate',''),('default_tax_4_name',''),('default_tax_4_rate',''),('default_tax_5_name',''),('default_tax_5_rate',''),('default_tax_rate','8'),('default_tech_is_logged_employee','0'),('default_tier_fixed_type_for_excel_import','fixed_amount'),('default_tier_percent_type_for_excel_import','percent_off'),('default_type_for_grid','categories'),('deleted_payment_types',''),('delivery_color_based_on','status'),('disable_confirm_recv','0'),('disable_confirmation_sale','0'),('disable_default_value_for_tracking_number','0'),('disable_discount_by_percentage','0'),('disable_discounts_percentage_per_line_item','0'),('disable_gift_cards_sold_from_loyalty','0'),('disable_giftcard_detection','0'),('disable_loyalty_by_default','0'),('disable_modules','a:0:{}'),('disable_price_rules_dialog','0'),('disable_quick_complete_sale','0'),('disable_recv_cloning','0'),('disable_recv_number_on_barcode','0'),('disable_sale_cloning','0'),('disable_sale_notifications','0'),('disable_signature_capture_on_terminal_for_phppos_credit_card_processing','0'),('disable_store_account_when_over_credit_limit','0'),('disable_supplier_selection_on_sales_interface','0'),('disable_test_mode','0'),('disable_variation_popup_in_receivings','0'),('disable_verification_for_qr_codes','0'),('disabled_fixed_discounts','0'),('discount_percent_earned','0'),('display_item_name_first_for_variation_name','0'),('do_not_allow_below_cost','0'),('do_not_allow_edit_of_overall_subtotal','0'),('do_not_allow_item_with_variations_to_be_sold_without_selecting_variation','0'),('do_not_allow_items_to_go_out_of_stock_when_transfering','0'),('do_not_allow_out_of_stock_items_to_be_sold','0'),('do_not_allow_sales_with_zero_value','0'),('do_not_allow_sales_with_zero_value_line_items','0'),('do_not_delete_saved_card_after_failure','0'),('do_not_delete_serial_number_when_selling','0'),('do_not_force_http','0'),('do_not_group_same_items','0'),('do_not_show_closing','0'),('do_not_tax_service_items_for_deliveries','0'),('do_not_treat_service_items_as_virtual','0'),('do_not_upload_images_to_ecommerce','0'),('dont_lock_suspended_sales','0'),('dont_recalculate_cost_price_when_unsuspending_estimates','0'),('dont_show_images_in_search_suggestions','0'),('easy_item_clone_button','0'),('ecom_store_location','1'),('ecommerce_cron_sync_operations','a:13:{i:0;s:22:\"sync_inventory_changes\";i:1;s:33:\"import_ecommerce_tags_into_phppos\";i:2;s:39:\"import_ecommerce_categories_into_phppos\";i:3;s:39:\"import_ecommerce_attributes_into_phppos\";i:4;s:30:\"import_tax_classes_into_phppos\";i:5;s:35:\"import_shipping_classes_into_phppos\";i:6;s:34:\"import_ecommerce_items_into_phppos\";i:7;s:35:\"import_ecommerce_orders_into_phppos\";i:8;s:31:\"export_phppos_tags_to_ecommerce\";i:9;s:37:\"export_phppos_categories_to_ecommerce\";i:10;s:37:\"export_phppos_attributes_to_ecommerce\";i:11;s:30:\"export_tax_classes_into_phppos\";i:12;s:32:\"export_phppos_items_to_ecommerce\";}'),('ecommerce_only_sync_completed_orders','0'),('ecommerce_platform',''),('ecommerce_realtime','0'),('ecommerce_suspended_sale_type_id','3'),('edit_customer_web_hook',''),('edit_item_price_if_zero_after_adding','0'),('edit_item_web_hook',''),('edit_recv_web_hook',''),('edit_sale_web_hook',''),('edit_work_order_web_hook',''),('email_charset',''),('email_provider','Use System Default'),('emailed_receipt_subject',''),('enable_customer_loyalty_system','0'),('enable_customer_quick_add','0'),('enable_ebt_payments','0'),('enable_ig_integration','0'),('enable_margin_calculator','0'),('enable_markup_calculator','0'),('enable_name_prefix','0'),('enable_p4_integration','0'),('enable_pdf_receipts','0'),('enable_points_for_giftcard_payments','0'),('enable_quick_customers',''),('enable_quick_edit','0'),('enable_quick_expense',''),('enable_quick_items',''),('enable_quick_suppliers',''),('enable_scale','0'),('enable_sounds','0'),('enable_supplier_quick_add','0'),('enable_tips','0'),('enable_wgp_integration','0'),('enable_wic','0'),('enhanced_search_method','0'),('fast_user_switching','0'),('flat_discounts_discount_tax','0'),('force_https','0'),('group_all_taxes_on_receipt','0'),('hide_all_prices_on_recv','0'),('hide_available_giftcards','0'),('hide_barcode_on_barcode_labels','0'),('hide_barcode_on_sales_and_recv_receipt','0'),('hide_categories_receivings_grid','0'),('hide_categories_sales_grid','0'),('hide_customer_recent_sales','0'),('hide_desc_emailed_receipts','0'),('hide_desc_on_receipt','0'),('hide_description_on_sales_and_recv','0'),('hide_description_on_suspended_sales','0'),('hide_email_on_receipts','0'),('hide_expire_dashboard','0'),('hide_expire_date_on_barcodes','0'),('hide_favorites_receivings_grid','0'),('hide_favorites_sales_grid','0'),('hide_images_in_grid','0'),('hide_item_descriptions_in_reports','0'),('hide_layaways_sales_in_reports','0'),('hide_location_name_on_receipt','0'),('hide_merchant_id_from_receipt','0'),('hide_name_on_barcodes','0'),('hide_out_of_stock_grid','0'),('hide_points_on_receipt','0'),('hide_price_on_barcodes','0'),('hide_prices_on_fill_sheet','0'),('hide_repair_items_in_sales_interface','0'),('hide_repair_items_on_receipt','0'),('hide_sales_to_discount_on_receipt','0'),('hide_signature','0'),('hide_size_field','1'),('hide_store_account_balance_on_receipt','0'),('hide_store_account_payments_from_report_totals','0'),('hide_store_account_payments_in_reports','0'),('hide_supplier_from_item_popup','0'),('hide_supplier_in_item_search_result','0'),('hide_supplier_on_recv_interface','0'),('hide_supplier_on_sales_interface','0'),('hide_suppliers_receivings_grid','0'),('hide_suppliers_sales_grid','0'),('hide_suspended_recv_in_reports','0'),('hide_tags_receivings_grid','0'),('hide_tags_sales_grid','0'),('hide_test_mode_home','0'),('hide_tier_on_receipt','0'),('highlight_low_inventory_items_in_items_module','0'),('id_to_show_on_barcode','id'),('id_to_show_on_sale_interface','number'),('ig_api_bearer_token',''),('import_all_past_orders_for_woo_commerce','0'),('import_ecommerce_orders_suspended','0'),('include_child_categories_when_searching_or_reporting','0'),('indicate_non_taxable_on_receipt','0'),('indicate_taxable_on_receipt','0'),('item_id_auto_increment','1'),('item_kit_id_auto_increment','1'),('item_lookup_order','a:6:{i:0;s:7:\"item_id\";i:1;s:11:\"item_number\";i:2;s:10:\"product_id\";i:3;s:23:\"additional_item_numbers\";i:4;s:14:\"serial_numbers\";i:5;s:26:\"item_variation_item_number\";}'),('items_per_search_suggestions','20'),('language','spanish'),('layaway_statement_message',''),('legacy_detailed_report_export','0'),('limit_manual_price_adj','0'),('lock_prices_suspended_sales','0'),('logout_on_clock_out','0'),('loyalty_option','simple'),('loyalty_points_without_tax','0'),('mailing_labels_type','pdf'),('markup_markdown','a:7:{s:8:\"Efectivo\";d:0;s:6:\"Cheque\";d:0;s:17:\"Tarjeta de regalo\";d:0;s:18:\"Tarjeta de débito\";d:0;s:19:\"Tarjeta de crédito\";d:0;s:18:\"Línea de crédito\";d:0;s:6:\"Puntos\";d:0;}'),('max_discount_percent',''),('minimum_points_to_redeem',''),('new_customer_web_hook',''),('new_item_web_hook',''),('new_items_are_ecommerce_by_default','1'),('new_receiving_web_hook',''),('new_sale_web_hook',''),('new_work_order_web_hook',''),('newline','\r\n'),('number_of_decimals',''),('number_of_decimals_displayed_on_sales_interface',''),('number_of_decimals_for_quantity_on_receipt',''),('number_of_items_in_grid','14'),('number_of_items_per_page','20'),('number_of_recent_sales','10'),('number_of_sales_for_discount',''),('offline_mode','0'),('offline_mode_sync_period','24'),('oidc_additional_scopes',''),('oidc_cert_url',''),('oidc_client_id',''),('oidc_groups_field',''),('oidc_host',''),('oidc_locations_field',''),('oidc_secret',''),('oidc_username_field',''),('online_price_tier','0'),('only_allow_current_location_customers','0'),('only_allow_current_location_employees','0'),('only_allow_sso_logins','0'),('override_employee_label_on_receipt',''),('override_receipt_title',''),('override_signature_text',''),('override_symbol_non_taxable',''),('override_symbol_non_taxable_summary',''),('override_symbol_taxable_summary',''),('override_tier_name',''),('overwrite_existing_items_on_excel_import','0'),('p4_api_bearer_token',''),('past_inventory_date','2025-05-08'),('paypal_me',''),('payvantage','0'),('pdf_receipt_message',''),('phppos_secure_key','58df913cb1bf3911c5df31dbe0b7f834'),('phppos_session_expiration','0'),('point_value',''),('prices_include_tax','0'),('print_after_receiving','0'),('print_after_sale','0'),('prompt_amount_for_cash_sale','0'),('prompt_for_ccv_swipe','0'),('prompt_for_sale_id_on_return','0'),('prompt_to_use_points','0'),('protocol',''),('qb_export_start_date',''),('qb_sync_operations','a:1:{i:0;s:33:\"export_journalentry_to_quickbooks\";}'),('qr_code_format','link_to_receipt'),('quick_variation_grid','0'),('receipt_download_filename_prefix',''),('receipt_text_size','small'),('receiving_id_auto_increment','1'),('redirect_to_sale_or_recv_screen_after_printing_receipt','0'),('remind_customer_facing_display','0'),('remove_commission_from_profit_in_reports','0'),('remove_customer_company_from_receipt','0'),('remove_customer_contact_info_from_receipt','0'),('remove_customer_name_from_receipt','0'),('remove_employee_from_receipt','0'),('remove_employee_lastname_from_receipt','0'),('remove_points_from_profit','0'),('remove_tax_percent_on_receipt','0'),('remove_weight_from_receipt','0'),('report_sort_order','asc'),('require_customer_for_return','0'),('require_customer_for_sale','0'),('require_customer_for_suspended_sale','0'),('require_employee_login_before_each_sale','0'),('require_receipt_for_return','0'),('require_supplier_for_recv','0'),('reset_location_when_switching_employee','0'),('return_policy','Change return policy'),('return_reasons',''),('round_cash_on_sales','0'),('round_tier_prices_to_2_decimals','0'),('sale_id_auto_increment','1'),('sale_prefix','POS'),('saml_email_field',''),('saml_first_name_field',''),('saml_groups_field',''),('saml_idp_entity_id',''),('saml_last_name_field',''),('saml_locations_field',''),('saml_name_id_format',''),('saml_single_logout_service',''),('saml_single_sign_on_service',''),('saml_x509_cert',''),('scale_divide_by','100'),('scale_format','scale_1'),('scan_and_set_recv','0'),('scan_and_set_sales','0'),('second_language',''),('select_sales_person_during_sale','0'),('send_sms_via_whatsapp','0'),('shopify_shop',''),('show_barcode_company_name','1'),('show_clock_on_header','0'),('show_custom_fields_label_service_tag_work_orders','0'),('show_custom_fields_service_tag_work_orders','0'),('show_estimated_repair_date_on_service_tag_work_orders','0'),('show_exchanged_totals_on_receipt','0'),('show_full_category_path','0'),('show_giftcards_even_if_0_balance','0'),('show_images_on_receipt','0'),('show_images_on_receipt_width_percent','25'),('show_item_description_service_tag','0'),('show_item_id_on_receipt','0'),('show_item_id_on_recv_receipt','0'),('show_item_kit_items_on_receipt','0'),('show_language_switcher','0'),('show_orig_price_if_marked_down_on_receipt','0'),('show_payments_on_work_order_sheet','0'),('show_person_id_on_receipt','0'),('show_phone_number_service_tag','0'),('show_prices_on_work_orders','0'),('show_qr_code_for_sale','0'),('show_receipt_after_suspending_sale','0'),('show_selling_price_on_recv','0'),('show_signature_on_receiving_receipt','0'),('show_tags_on_fulfillment_sheet','0'),('show_tax_per_item_on_receipt','0'),('show_total_at_top_on_receipt','0'),('show_total_discount_on_receipt','0'),('show_total_on_fulfillment','0'),('shown_setup_wizard','0'),('sku_sync_field','item_number'),('smtp_crypto',''),('smtp_host',''),('smtp_pass',''),('smtp_port',''),('smtp_timeout',''),('smtp_user',''),('sort_receipt_column',''),('speed_up_search_queries','0'),('spend_to_point_ratio',''),('spreadsheet_format','XLSX'),('sso_protocol','saml'),('store_account_statement_message',''),('store_closing_time',''),('store_opening_time',''),('strict_age_format_check','0'),('suppliers_store_accounts','0'),('supports_full_text','1'),('tax_class_id','1'),('tax_id',''),('tax_jar_location','0'),('taxes_summary_details_on_receipt','0'),('taxes_summary_on_receipt','0'),('taxjar_api_key',''),('test_mode','0'),('thousands_separator',','),('time_format','12_hour'),('timeclock','0'),('timeclock_pto','0'),('tip_preset_zero','0'),('track_cash','0'),('track_payment_types','a:0:{}'),('track_shipping_cost_recv','0'),('turn_on_review_requests','0'),('update_base_cost_price_from_units','0'),('update_cost_price_on_transfer','0'),('uppercase_receipts','0'),('use_main_image_as_default_image_in_e_commerce','0'),('use_rtl_barcode_library','0'),('use_saudi_tax_config','0'),('use_saudi_tax_test_config','0'),('use_tier_price_for_price_check',''),('user_configured_estimate_name',''),('user_configured_layaway_name',''),('validate_location_id_of_customer_when_adding_to_sale','0'),('verify_age_for_products','0'),('version','19.4'),('virtual_keyboard',''),('website',''),('week_start_day','monday'),('wgp_integration_pkey',''),('wgp_integration_userid',''),('wide_printer_receipt_format','0'),('wizard_add_customer','1'),('wizard_add_inventory','1'),('wizard_configure_company','1'),('wizard_create_sale','1'),('woo_api_key',''),('woo_api_secret',''),('woo_api_url',''),('woo_enable_html_desc','0'),('woo_version','3.0.0'),('work_order_device_locations',''),('work_order_notes_internal','0'),('work_order_status_on_complete',''),('work_orders_show_condensed_receipt','0'),('work_repair_item_taxable','0');
/*!40000 ALTER TABLE `phppos_app_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_app_files`
--

DROP TABLE IF EXISTS `phppos_app_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_app_files` (
  `file_id` int(10) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_data` longblob NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expires` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`file_id`),
  KEY `expires` (`expires`),
  KEY `file_name` (`file_name`),
  KEY `timestamp` (`timestamp`),
  KEY `filename_timestamp` (`file_name`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_app_files`
--

LOCK TABLES `phppos_app_files` WRITE;
/*!40000 ALTER TABLE `phppos_app_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_app_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_appointment_types`
--

DROP TABLE IF EXISTS `phppos_appointment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_appointment_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_appointment_types`
--

LOCK TABLES `phppos_appointment_types` WRITE;
/*!40000 ALTER TABLE `phppos_appointment_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_appointment_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_appointments`
--

DROP TABLE IF EXISTS `phppos_appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(10) NOT NULL,
  `person_id` int(10) DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `appointments_type_id` int(10) NOT NULL,
  `notes` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `phppos_appointments_ibfk_1` (`appointments_type_id`),
  KEY `phppos_appointments_ibfk_2` (`person_id`),
  KEY `phppos_appointments_ibfk_3` (`location_id`),
  KEY `phppos_appointments_ibfk_4` (`employee_id`),
  CONSTRAINT `phppos_appointments_ibfk_1` FOREIGN KEY (`appointments_type_id`) REFERENCES `phppos_appointment_types` (`id`),
  CONSTRAINT `phppos_appointments_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `phppos_people` (`person_id`),
  CONSTRAINT `phppos_appointments_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_appointments_ibfk_4` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_appointments`
--

LOCK TABLES `phppos_appointments` WRITE;
/*!40000 ALTER TABLE `phppos_appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_attribute_values`
--

DROP TABLE IF EXISTS `phppos_attribute_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_attribute_values` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ecommerce_attribute_term_id` varchar(255) NOT NULL,
  `attribute_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_attribute_id` (`name`,`attribute_id`),
  KEY `phppos_attribute_values_ibfk_1` (`attribute_id`),
  CONSTRAINT `phppos_attribute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `phppos_attributes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_attribute_values`
--

LOCK TABLES `phppos_attribute_values` WRITE;
/*!40000 ALTER TABLE `phppos_attribute_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_attribute_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_attributes`
--

DROP TABLE IF EXISTS `phppos_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_attributes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `ecommerce_attribute_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`item_id`,`name`),
  CONSTRAINT `phppos_attributes_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_attributes`
--

LOCK TABLES `phppos_attributes` WRITE;
/*!40000 ALTER TABLE `phppos_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_categories`
--

DROP TABLE IF EXISTS `phppos_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ecommerce_category_id` varchar(255) DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(1) NOT NULL DEFAULT 0,
  `hide_from_grid` int(1) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image_id` int(10) DEFAULT NULL,
  `color` text DEFAULT NULL,
  `system_category` int(1) DEFAULT 0,
  `exclude_from_e_commerce` int(1) NOT NULL DEFAULT 0,
  `category_info_popup` text DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`),
  KEY `phppos_categories_ibfk_1` (`parent_id`),
  KEY `phppos_categories_ibfk_2` (`image_id`),
  KEY `name` (`name`),
  CONSTRAINT `phppos_categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `phppos_categories` (`id`),
  CONSTRAINT `phppos_categories_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `phppos_app_files` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_categories`
--

LOCK TABLES `phppos_categories` WRITE;
/*!40000 ALTER TABLE `phppos_categories` DISABLE KEYS */;
INSERT INTO `phppos_categories` VALUES (1,NULL,'2025-05-08 20:59:56',0,0,NULL,'Bebida sin alcohol',NULL,'',0,0,NULL,''),(2,NULL,'2025-05-12 20:24:27',0,0,NULL,'Lácteos',NULL,'',0,0,NULL,''),(3,NULL,'2025-05-13 14:31:03',0,0,NULL,'Electrónica',NULL,'',0,0,NULL,''),(4,NULL,'2025-05-13 14:32:47',0,0,NULL,'Alimentos Secos',NULL,'',0,0,NULL,''),(5,NULL,'2025-05-15 16:12:54',0,1,NULL,'Discount',NULL,'',1,0,NULL,''),(6,NULL,'2025-05-16 17:51:25',0,1,NULL,'Artículo de reparación',NULL,'',0,0,NULL,''),(7,NULL,'2025-05-17 16:23:07',0,1,NULL,'Artículo de reparación',NULL,'',0,0,NULL,'');
/*!40000 ALTER TABLE `phppos_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_codigos_cufd`
--

DROP TABLE IF EXISTS `phppos_codigos_cufd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_codigos_cufd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_cufd` varchar(255) DEFAULT NULL,
  `codigo_control` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_vigencia` datetime DEFAULT NULL,
  `nro_sucursal` int(11) DEFAULT NULL,
  `nro_punto_venta` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_codigos_cufd`
--

LOCK TABLES `phppos_codigos_cufd` WRITE;
/*!40000 ALTER TABLE `phppos_codigos_cufd` DISABLE KEYS */;
INSERT INTO `phppos_codigos_cufd` VALUES (1,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:12:06'),(2,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:12:06'),(3,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:12:40'),(4,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:12:40'),(5,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:13:07'),(6,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:13:07'),(7,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:14:08'),(8,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:14:08'),(9,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:28:03'),(10,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:28:03'),(11,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:29:03'),(12,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:29:03'),(13,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:29:12'),(14,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:29:12'),(15,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:39:24'),(16,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:39:24'),(17,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:39:46'),(18,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:39:46'),(19,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:42:40'),(20,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:42:40'),(21,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-21 20:59:13'),(22,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-21 20:59:13'),(23,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 13:02:52'),(24,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 13:02:52'),(25,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 13:04:39'),(26,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 13:04:39'),(27,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 14:14:20'),(28,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 14:14:20'),(29,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 14:15:33'),(30,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 14:15:33'),(31,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 14:15:38'),(32,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 14:15:38'),(33,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 15:22:00'),(34,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 15:22:00'),(35,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 16:43:10'),(36,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 16:43:16'),(37,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 16:43:39'),(38,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 16:43:44'),(39,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 16:43:53'),(40,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 16:47:33'),(41,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 16:47:39'),(42,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 16:47:49'),(43,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 17:23:00'),(44,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 17:23:00'),(45,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 17:29:27'),(46,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 17:29:27'),(47,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 18:11:11'),(48,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 18:11:11'),(49,'BQUFlQz96NEFBODTcxNUEwNUU1REY=QsKhSEpXS0JEWlVE0Q0MwOEVGRjU3O','553E17A4A971F74','2025-02-28 10:22:09','2025-03-01 10:22:09',0,0,'ACTIVO','2025-05-22 19:00:44'),(50,'BQUFlQz96NEFBODTcxNUEwNUU1REY=Qj7CsFlqS0JEWlVE0Q0MwOEVGRjU3O','7A423BB4A971F74','2025-02-28 10:35:25','2025-03-01 10:35:24',0,0,'ACTIVO','2025-05-22 19:00:44');
/*!40000 ALTER TABLE `phppos_codigos_cufd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_credit_card_transactions_unconfirmed`
--

DROP TABLE IF EXISTS `phppos_credit_card_transactions_unconfirmed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_credit_card_transactions_unconfirmed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_of_charge` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `register_id_of_charge` int(11) DEFAULT NULL,
  `transaction_charge_id` varchar(255) NOT NULL,
  `amount` decimal(23,10) DEFAULT NULL,
  `cart_data` longblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_credit_card_transactions_charged_ibfk_1` (`register_id_of_charge`),
  KEY `phppos_cctc_transaction_charge_id_index` (`transaction_charge_id`),
  CONSTRAINT `phppos_credit_card_transactions_charged_ibfk_1` FOREIGN KEY (`register_id_of_charge`) REFERENCES `phppos_registers` (`register_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_credit_card_transactions_unconfirmed`
--

LOCK TABLES `phppos_credit_card_transactions_unconfirmed` WRITE;
/*!40000 ALTER TABLE `phppos_credit_card_transactions_unconfirmed` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_credit_card_transactions_unconfirmed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_currency_exchange_rates`
--

DROP TABLE IF EXISTS `phppos_currency_exchange_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_currency_exchange_rates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `currency_code_to` varchar(255) NOT NULL,
  `currency_symbol` varchar(255) NOT NULL,
  `exchange_rate` decimal(23,10) NOT NULL,
  `currency_symbol_location` varchar(255) NOT NULL DEFAULT '',
  `number_of_decimals` varchar(255) NOT NULL DEFAULT '',
  `thousands_separator` varchar(255) NOT NULL DEFAULT '',
  `decimal_point` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_currency_exchange_rates`
--

LOCK TABLES `phppos_currency_exchange_rates` WRITE;
/*!40000 ALTER TABLE `phppos_currency_exchange_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_currency_exchange_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customer_invoice_details`
--

DROP TABLE IF EXISTS `phppos_customer_invoice_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customer_invoice_details` (
  `invoice_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `line_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `total` decimal(23,10) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`invoice_details_id`) USING BTREE,
  KEY `phppos_customer_invoice_details_ibfk_1` (`sale_id`),
  KEY `phppos_customer_invoice_details_ibfk_2` (`invoice_id`),
  CONSTRAINT `phppos_customer_invoice_details_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_customer_invoice_details_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `phppos_customer_invoices` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customer_invoice_details`
--

LOCK TABLES `phppos_customer_invoice_details` WRITE;
/*!40000 ALTER TABLE `phppos_customer_invoice_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_customer_invoice_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customer_invoice_payments`
--

DROP TABLE IF EXISTS `phppos_customer_invoice_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customer_invoice_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_type` varchar(255) NOT NULL,
  `payment_amount` decimal(23,10) NOT NULL,
  `auth_code` varchar(255) DEFAULT '',
  `ref_no` varchar(255) DEFAULT '',
  `cc_token` varchar(255) DEFAULT '',
  `acq_ref_data` varchar(255) DEFAULT '',
  `process_data` varchar(255) DEFAULT '',
  `entry_method` varchar(255) DEFAULT '',
  `aid` varchar(255) DEFAULT '',
  `tvr` varchar(255) DEFAULT '',
  `iad` varchar(255) DEFAULT '',
  `tsi` varchar(255) DEFAULT '',
  `arc` varchar(255) DEFAULT '',
  `cvm` varchar(255) DEFAULT '',
  `tran_type` varchar(255) DEFAULT '',
  `application_label` varchar(255) DEFAULT '',
  `truncated_card` varchar(255) DEFAULT '',
  `card_issuer` varchar(255) DEFAULT '',
  PRIMARY KEY (`payment_id`) USING BTREE,
  KEY `phppos_customer_invoice_payments_ibfk_1` (`invoice_id`),
  CONSTRAINT `phppos_customer_invoice_payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `phppos_customer_invoices` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customer_invoice_payments`
--

LOCK TABLES `phppos_customer_invoice_payments` WRITE;
/*!40000 ALTER TABLE `phppos_customer_invoice_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_customer_invoice_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customer_invoices`
--

DROP TABLE IF EXISTS `phppos_customer_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customer_invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_po` varchar(255) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `total` decimal(23,10) DEFAULT NULL,
  `balance` decimal(23,10) DEFAULT NULL,
  `last_paid` date DEFAULT NULL,
  `deleted` int(1) DEFAULT 0,
  PRIMARY KEY (`invoice_id`) USING BTREE,
  KEY `phppos_customer_invoices_ibfk_1` (`term_id`),
  KEY `phppos_customer_invoices_ibfk_2` (`customer_id`),
  KEY `phppos_customer_invoices_ibfk_3` (`location_id`),
  CONSTRAINT `phppos_customer_invoices_ibfk_1` FOREIGN KEY (`term_id`) REFERENCES `phppos_terms` (`term_id`),
  CONSTRAINT `phppos_customer_invoices_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `phppos_customers` (`person_id`),
  CONSTRAINT `phppos_customer_invoices_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customer_invoices`
--

LOCK TABLES `phppos_customer_invoices` WRITE;
/*!40000 ALTER TABLE `phppos_customer_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_customer_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customer_subscriptions`
--

DROP TABLE IF EXISTS `phppos_customer_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customer_subscriptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) DEFAULT NULL,
  `location_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `variation_id` int(10) DEFAULT NULL,
  `startup_cost` decimal(23,10) DEFAULT 0.0000000000,
  `recurring_charge_amount` decimal(23,10) DEFAULT 0.0000000000,
  `customer_id` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `interval` varchar(255) DEFAULT NULL,
  `weekday` int(1) DEFAULT NULL,
  `day_number` int(10) DEFAULT NULL,
  `month` int(10) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `next_payment_date` date DEFAULT NULL,
  `next_retry_date` date DEFAULT NULL,
  `retries_attempted` int(10) DEFAULT 0,
  `card_on_file_token` varchar(255) DEFAULT NULL,
  `card_on_file_masked` varchar(255) DEFAULT NULL,
  `card_on_file_expiration_date` date DEFAULT NULL,
  `deleted` int(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `phppos_customer_subscriptions_ibfk_1` (`sale_id`),
  KEY `phppos_customer_subscriptions_ibfk_2` (`item_id`),
  KEY `phppos_customer_subscriptions_ibfk_3` (`variation_id`),
  KEY `phppos_customer_subscriptions_ibfk_4` (`customer_id`),
  KEY `phppos_customer_subscriptions_ibfk_5` (`location_id`),
  CONSTRAINT `phppos_customer_subscriptions_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_customer_subscriptions_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_customer_subscriptions_ibfk_3` FOREIGN KEY (`variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_customer_subscriptions_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `phppos_customers` (`person_id`),
  CONSTRAINT `phppos_customer_subscriptions_ibfk_5` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customer_subscriptions`
--

LOCK TABLES `phppos_customer_subscriptions` WRITE;
/*!40000 ALTER TABLE `phppos_customer_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_customer_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customers`
--

DROP TABLE IF EXISTS `phppos_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `override_default_tax` int(1) NOT NULL DEFAULT 0,
  `company_name` varchar(255) NOT NULL,
  `balance` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `credit_limit` decimal(23,10) DEFAULT NULL,
  `points` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `disable_loyalty` int(1) NOT NULL DEFAULT 0,
  `current_spend_for_points` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `current_sales_for_discount` int(10) NOT NULL DEFAULT 0,
  `taxable` int(1) NOT NULL DEFAULT 1,
  `tax_certificate` varchar(255) NOT NULL DEFAULT '',
  `cc_token` varchar(255) DEFAULT NULL,
  `cc_expire` varchar(255) DEFAULT NULL,
  `cc_ref_no` varchar(255) DEFAULT NULL,
  `cc_preview` varchar(255) DEFAULT NULL,
  `card_issuer` varchar(255) DEFAULT '',
  `tier_id` int(10) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `tax_class_id` int(10) DEFAULT NULL,
  `custom_field_1_value` varchar(255) DEFAULT NULL,
  `custom_field_2_value` varchar(255) DEFAULT NULL,
  `custom_field_3_value` varchar(255) DEFAULT NULL,
  `custom_field_4_value` varchar(255) DEFAULT NULL,
  `custom_field_5_value` varchar(255) DEFAULT NULL,
  `custom_field_6_value` varchar(255) DEFAULT NULL,
  `custom_field_7_value` varchar(255) DEFAULT NULL,
  `custom_field_8_value` varchar(255) DEFAULT NULL,
  `custom_field_9_value` varchar(255) DEFAULT NULL,
  `custom_field_10_value` varchar(255) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `internal_notes` text NOT NULL,
  `customer_info_popup` text DEFAULT NULL,
  `auto_email_receipt` int(1) NOT NULL DEFAULT 0,
  `always_sms_receipt` int(1) NOT NULL DEFAULT 0,
  `default_term_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_number` (`account_number`),
  KEY `person_id` (`person_id`),
  KEY `deleted` (`deleted`),
  KEY `cc_token` (`cc_token`),
  KEY `phppos_customers_ibfk_2` (`tier_id`),
  KEY `company_name` (`company_name`),
  KEY `phppos_customers_ibfk_3` (`tax_class_id`),
  KEY `custom_field_1_value` (`custom_field_1_value`),
  KEY `custom_field_2_value` (`custom_field_2_value`),
  KEY `custom_field_3_value` (`custom_field_3_value`),
  KEY `custom_field_4_value` (`custom_field_4_value`),
  KEY `custom_field_5_value` (`custom_field_5_value`),
  KEY `custom_field_6_value` (`custom_field_6_value`),
  KEY `custom_field_7_value` (`custom_field_7_value`),
  KEY `custom_field_8_value` (`custom_field_8_value`),
  KEY `custom_field_9_value` (`custom_field_9_value`),
  KEY `custom_field_10_value` (`custom_field_10_value`),
  KEY `phppos_customers_ibfk_4` (`location_id`),
  KEY `phppos_suppliers_ibfk_3` (`default_term_id`),
  CONSTRAINT `phppos_customers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `phppos_people` (`person_id`),
  CONSTRAINT `phppos_customers_ibfk_2` FOREIGN KEY (`tier_id`) REFERENCES `phppos_price_tiers` (`id`),
  CONSTRAINT `phppos_customers_ibfk_3` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`),
  CONSTRAINT `phppos_customers_ibfk_4` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_customers_ibfk_5` FOREIGN KEY (`default_term_id`) REFERENCES `phppos_terms` (`term_id`),
  CONSTRAINT `phppos_suppliers_ibfk_3` FOREIGN KEY (`default_term_id`) REFERENCES `phppos_terms` (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customers`
--

LOCK TABLES `phppos_customers` WRITE;
/*!40000 ALTER TABLE `phppos_customers` DISABLE KEYS */;
INSERT INTO `phppos_customers` VALUES (1,2,NULL,0,'',0.0000000000,NULL,0.0000000000,0,0.0000000000,0,1,'',NULL,NULL,NULL,NULL,'',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,0,NULL),(2,3,'78234512',0,'',0.0000000000,NULL,0.0000000000,0,0.0000000000,0,1,'',NULL,NULL,NULL,NULL,'',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,0,NULL),(3,4,'4856487789',0,'',0.0000000000,NULL,0.0000000000,0,0.0000000000,0,1,'',NULL,NULL,NULL,NULL,'',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,0,NULL);
/*!40000 ALTER TABLE `phppos_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customers_series`
--

DROP TABLE IF EXISTS `phppos_customers_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customers_series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `item_id` int(1) NOT NULL DEFAULT 0,
  `expire_date` date DEFAULT NULL,
  `quantity_remaining` decimal(23,10) DEFAULT 0.0000000000,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_customers_series_ibfk_1` (`item_id`),
  KEY `phppos_customers_series_ibfk_2` (`customer_id`),
  KEY `phppos_customers_series_ibfk_3` (`sale_id`),
  CONSTRAINT `phppos_customers_series_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_customers_series_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `phppos_people` (`person_id`),
  CONSTRAINT `phppos_customers_series_ibfk_3` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customers_series`
--

LOCK TABLES `phppos_customers_series` WRITE;
/*!40000 ALTER TABLE `phppos_customers_series` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_customers_series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customers_series_log`
--

DROP TABLE IF EXISTS `phppos_customers_series_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customers_series_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `series_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity_used` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_customers_series_log_ibfk_1` (`series_id`),
  CONSTRAINT `phppos_customers_series_log_ibfk_1` FOREIGN KEY (`series_id`) REFERENCES `phppos_customers_series` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customers_series_log`
--

LOCK TABLES `phppos_customers_series_log` WRITE;
/*!40000 ALTER TABLE `phppos_customers_series_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_customers_series_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customers_taxes`
--

DROP TABLE IF EXISTS `phppos_customers_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customers_taxes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tax` (`customer_id`,`name`,`percent`),
  CONSTRAINT `phppos_customers_taxes_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `phppos_customers` (`person_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customers_taxes`
--

LOCK TABLES `phppos_customers_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_customers_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_customers_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_customers_zatca`
--

DROP TABLE IF EXISTS `phppos_customers_zatca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_customers_zatca` (
  `customer_id` int(10) NOT NULL,
  `buyer_party_postal_street_name` varchar(100) NOT NULL,
  `buyer_party_postal_building_number` varchar(100) NOT NULL,
  `buyer_party_postal_code` varchar(100) NOT NULL,
  `buyer_party_postal_city` varchar(100) NOT NULL,
  `buyer_party_postal_district` varchar(100) NOT NULL,
  `buyer_party_postal_plot_id` varchar(100) NOT NULL,
  `buyer_party_postal_country` varchar(10) NOT NULL,
  `buyer_id` varchar(100) NOT NULL,
  `buyer_scheme_id` varchar(10) NOT NULL,
  `buyer_tax_id` varchar(100) NOT NULL,
  UNIQUE KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_customers_zatca`
--

LOCK TABLES `phppos_customers_zatca` WRITE;
/*!40000 ALTER TABLE `phppos_customers_zatca` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_customers_zatca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_damaged_items_log`
--

DROP TABLE IF EXISTS `phppos_damaged_items_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_damaged_items_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `damaged_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `damaged_qty` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `item_id` int(10) NOT NULL,
  `item_variation_id` int(10) DEFAULT NULL,
  `sale_id` int(10) DEFAULT NULL,
  `location_id` int(10) NOT NULL,
  `damaged_reason` varchar(255) DEFAULT NULL,
  `damaged_reason_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_damaged_items_log_ibfk_1` (`item_id`),
  KEY `phppos_damaged_items_log_ibfk_2` (`item_variation_id`),
  KEY `phppos_damaged_items_log_ibfk_3` (`sale_id`),
  KEY `phppos_damaged_items_log_ibfk_4` (`location_id`),
  CONSTRAINT `phppos_damaged_items_log_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_damaged_items_log_ibfk_2` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_damaged_items_log_ibfk_3` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_damaged_items_log_ibfk_4` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_damaged_items_log`
--

LOCK TABLES `phppos_damaged_items_log` WRITE;
/*!40000 ALTER TABLE `phppos_damaged_items_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_damaged_items_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_delivery_categories`
--

DROP TABLE IF EXISTS `phppos_delivery_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_delivery_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `delivery_category_name` (`name`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_delivery_categories`
--

LOCK TABLES `phppos_delivery_categories` WRITE;
/*!40000 ALTER TABLE `phppos_delivery_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_delivery_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_delivery_email_templates`
--

DROP TABLE IF EXISTS `phppos_delivery_email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_delivery_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_delivery_email_templates`
--

LOCK TABLES `phppos_delivery_email_templates` WRITE;
/*!40000 ALTER TABLE `phppos_delivery_email_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_delivery_email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_delivery_files`
--

DROP TABLE IF EXISTS `phppos_delivery_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_delivery_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `delivery_id` (`delivery_id`),
  CONSTRAINT `phppos_delivery_files_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `phppos_app_files` (`file_id`),
  CONSTRAINT `phppos_delivery_files_ibfk_2` FOREIGN KEY (`delivery_id`) REFERENCES `phppos_sales_deliveries` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_delivery_files`
--

LOCK TABLES `phppos_delivery_files` WRITE;
/*!40000 ALTER TABLE `phppos_delivery_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_delivery_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_delivery_item_kits`
--

DROP TABLE IF EXISTS `phppos_delivery_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_delivery_item_kits` (
  `delivery_item_kits_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) DEFAULT NULL,
  `item_kit_id` int(11) DEFAULT NULL,
  `quantity` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`delivery_item_kits_id`),
  KEY `delivery_id` (`delivery_id`),
  KEY `item_kit_id` (`item_kit_id`),
  CONSTRAINT `phppos_delivery_item_kits_ibfk_1` FOREIGN KEY (`delivery_id`) REFERENCES `phppos_sales_deliveries` (`id`),
  CONSTRAINT `phppos_delivery_item_kits_ibfk_2` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_delivery_item_kits`
--

LOCK TABLES `phppos_delivery_item_kits` WRITE;
/*!40000 ALTER TABLE `phppos_delivery_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_delivery_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_delivery_items`
--

DROP TABLE IF EXISTS `phppos_delivery_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_delivery_items` (
  `delivery_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_variation_id` int(11) DEFAULT NULL,
  `quantity` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`delivery_items_id`),
  KEY `delivery_id` (`delivery_id`),
  KEY `item_id` (`item_id`),
  KEY `item_variation_id` (`item_variation_id`),
  CONSTRAINT `phppos_delivery_items_ibfk_1` FOREIGN KEY (`delivery_id`) REFERENCES `phppos_sales_deliveries` (`id`),
  CONSTRAINT `phppos_delivery_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_delivery_items_ibfk_3` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_delivery_items`
--

LOCK TABLES `phppos_delivery_items` WRITE;
/*!40000 ALTER TABLE `phppos_delivery_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_delivery_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_delivery_statuses`
--

DROP TABLE IF EXISTS `phppos_delivery_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_delivery_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `color` text DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notify_by_email` int(1) DEFAULT 0,
  `notify_by_sms` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_delivery_statuses`
--

LOCK TABLES `phppos_delivery_statuses` WRITE;
/*!40000 ALTER TABLE `phppos_delivery_statuses` DISABLE KEYS */;
INSERT INTO `phppos_delivery_statuses` VALUES (1,'Not Scheduled','Not Scheduled','#FF0179','2021-08-23 11:28:11',1,1),(2,'Scheduled','Scheduled','#02B085','2021-08-23 11:28:11',1,1),(3,'Shipped','Shipped','#0072C6','2021-08-23 11:28:11',1,1),(4,'Delivered','Delivered','#5F0082','2021-08-23 11:28:11',1,1);
/*!40000 ALTER TABLE `phppos_delivery_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_ecommerce_locations`
--

DROP TABLE IF EXISTS `phppos_ecommerce_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_ecommerce_locations` (
  `location_id` int(10) NOT NULL,
  PRIMARY KEY (`location_id`),
  CONSTRAINT `phppos_ecommerce_locations_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_ecommerce_locations`
--

LOCK TABLES `phppos_ecommerce_locations` WRITE;
/*!40000 ALTER TABLE `phppos_ecommerce_locations` DISABLE KEYS */;
INSERT INTO `phppos_ecommerce_locations` VALUES (1);
/*!40000 ALTER TABLE `phppos_ecommerce_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_employee_registers`
--

DROP TABLE IF EXISTS `phppos_employee_registers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_employee_registers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `register_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_employee_registers_ibfk_1` (`employee_id`),
  KEY `phppos_employee_registers_ibfk_2` (`register_id`),
  CONSTRAINT `phppos_employee_registers_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_employee_registers_ibfk_2` FOREIGN KEY (`register_id`) REFERENCES `phppos_registers` (`register_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_employee_registers`
--

LOCK TABLES `phppos_employee_registers` WRITE;
/*!40000 ALTER TABLE `phppos_employee_registers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_employee_registers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_employees`
--

DROP TABLE IF EXISTS `phppos_employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_employees` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `force_password_change` int(1) NOT NULL DEFAULT 0,
  `always_require_password` int(1) NOT NULL DEFAULT 0,
  `person_id` int(10) NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `commission_percent` decimal(23,10) DEFAULT 0.0000000000,
  `commission_percent_type` varchar(255) DEFAULT '',
  `hourly_pay_rate` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `not_required_to_clock_in` int(1) NOT NULL DEFAULT 0,
  `inactive` int(1) NOT NULL DEFAULT 0,
  `reason_inactive` text DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `employee_number` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `termination_date` date DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `custom_field_1_value` varchar(255) DEFAULT NULL,
  `custom_field_2_value` varchar(255) DEFAULT NULL,
  `custom_field_3_value` varchar(255) DEFAULT NULL,
  `custom_field_4_value` varchar(255) DEFAULT NULL,
  `custom_field_5_value` varchar(255) DEFAULT NULL,
  `custom_field_6_value` varchar(255) DEFAULT NULL,
  `custom_field_7_value` varchar(255) DEFAULT NULL,
  `custom_field_8_value` varchar(255) DEFAULT NULL,
  `custom_field_9_value` varchar(255) DEFAULT NULL,
  `custom_field_10_value` varchar(255) DEFAULT NULL,
  `max_discount_percent` decimal(15,3) DEFAULT NULL,
  `login_start_time` time DEFAULT NULL,
  `login_end_time` time DEFAULT NULL,
  `dark_mode` int(1) NOT NULL DEFAULT 0,
  `template_id` int(11) DEFAULT NULL,
  `override_price_adjustments` int(1) DEFAULT 0,
  `allowed_ip_address` text DEFAULT NULL,
  `secret_key_2fa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `employee_number` (`employee_number`),
  KEY `person_id` (`person_id`),
  KEY `deleted` (`deleted`),
  KEY `custom_field_1_value` (`custom_field_1_value`),
  KEY `custom_field_2_value` (`custom_field_2_value`),
  KEY `custom_field_3_value` (`custom_field_3_value`),
  KEY `custom_field_4_value` (`custom_field_4_value`),
  KEY `custom_field_5_value` (`custom_field_5_value`),
  KEY `custom_field_6_value` (`custom_field_6_value`),
  KEY `custom_field_7_value` (`custom_field_7_value`),
  KEY `custom_field_8_value` (`custom_field_8_value`),
  KEY `custom_field_9_value` (`custom_field_9_value`),
  KEY `custom_field_10_value` (`custom_field_10_value`),
  KEY `template_id` (`template_id`),
  CONSTRAINT `phppos_employees_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `phppos_people` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_employees`
--

LOCK TABLES `phppos_employees` WRITE;
/*!40000 ALTER TABLE `phppos_employees` DISABLE KEYS */;
INSERT INTO `phppos_employees` VALUES (1,'admin','439a6de57d475c1a0ba9bcb1c39f0af6',0,0,1,NULL,0.0000000000,'',0.0000000000,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `phppos_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_employees_app_config`
--

DROP TABLE IF EXISTS `phppos_employees_app_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_employees_app_config` (
  `employee_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`employee_id`,`key`),
  CONSTRAINT `phppos_employees_app_config_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_employees_app_config`
--

LOCK TABLES `phppos_employees_app_config` WRITE;
/*!40000 ALTER TABLE `phppos_employees_app_config` DISABLE KEYS */;
INSERT INTO `phppos_employees_app_config` VALUES (1,'hide_completed_work_orders','0');
/*!40000 ALTER TABLE `phppos_employees_app_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_employees_locations`
--

DROP TABLE IF EXISTS `phppos_employees_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_employees_locations` (
  `employee_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  PRIMARY KEY (`employee_id`,`location_id`),
  KEY `phppos_employees_locations_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_employees_locations_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_employees_locations_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_employees_locations`
--

LOCK TABLES `phppos_employees_locations` WRITE;
/*!40000 ALTER TABLE `phppos_employees_locations` DISABLE KEYS */;
INSERT INTO `phppos_employees_locations` VALUES (1,1);
/*!40000 ALTER TABLE `phppos_employees_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_employees_reset_password`
--

DROP TABLE IF EXISTS `phppos_employees_reset_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_employees_reset_password` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `expire` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `phppos_employees_reset_password_ibfk_1` (`employee_id`),
  CONSTRAINT `phppos_employees_reset_password_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_employees_reset_password`
--

LOCK TABLES `phppos_employees_reset_password` WRITE;
/*!40000 ALTER TABLE `phppos_employees_reset_password` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_employees_reset_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_employees_time_clock`
--

DROP TABLE IF EXISTS `phppos_employees_time_clock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_employees_time_clock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `clock_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `clock_out` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `clock_in_comment` text NOT NULL,
  `clock_out_comment` text NOT NULL,
  `hourly_pay_rate` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `ip_address_clock_in` varchar(255) NOT NULL,
  `ip_address_clock_out` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_employees_time_clock_ibfk_1` (`employee_id`),
  KEY `phppos_employees_time_clock_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_employees_time_clock_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_employees_time_clock_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_employees_time_clock`
--

LOCK TABLES `phppos_employees_time_clock` WRITE;
/*!40000 ALTER TABLE `phppos_employees_time_clock` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_employees_time_clock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_employees_time_off`
--

DROP TABLE IF EXISTS `phppos_employees_time_off`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_employees_time_off` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `approved` int(1) NOT NULL DEFAULT 0,
  `start_day` date DEFAULT NULL,
  `end_day` date DEFAULT NULL,
  `hours_requested` decimal(23,10) DEFAULT 0.0000000000,
  `is_paid` int(1) NOT NULL DEFAULT 0,
  `reason` varchar(255) DEFAULT NULL,
  `employee_requested_person_id` int(10) DEFAULT NULL,
  `employee_requested_location_id` int(10) DEFAULT NULL,
  `employee_approved_person_id` int(10) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `phppos_employees_time_off_ibfk_1` (`employee_requested_person_id`),
  KEY `phppos_employees_time_off_ibfk_2` (`employee_approved_person_id`),
  KEY `phppos_employees_time_off_ibfk_3` (`employee_requested_location_id`),
  CONSTRAINT `phppos_employees_time_off_ibfk_1` FOREIGN KEY (`employee_requested_person_id`) REFERENCES `phppos_people` (`person_id`),
  CONSTRAINT `phppos_employees_time_off_ibfk_2` FOREIGN KEY (`employee_approved_person_id`) REFERENCES `phppos_people` (`person_id`),
  CONSTRAINT `phppos_employees_time_off_ibfk_3` FOREIGN KEY (`employee_requested_location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_employees_time_off`
--

LOCK TABLES `phppos_employees_time_off` WRITE;
/*!40000 ALTER TABLE `phppos_employees_time_off` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_employees_time_off` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_expenses`
--

DROP TABLE IF EXISTS `phppos_expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_expenses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `location_id` int(10) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `expense_type` varchar(255) NOT NULL,
  `expense_description` text DEFAULT NULL,
  `expense_reason` varchar(255) DEFAULT NULL,
  `expense_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `expense_amount` decimal(23,10) NOT NULL,
  `expense_tax` decimal(23,10) NOT NULL,
  `expense_note` text NOT NULL,
  `employee_id` int(10) NOT NULL,
  `approved_employee_id` int(10) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `expense_payment_type` varchar(255) NOT NULL,
  `expense_image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  KEY `employee_id` (`employee_id`),
  KEY `approved_employee_id` (`approved_employee_id`),
  KEY `category_id` (`category_id`),
  KEY `deleted` (`deleted`),
  KEY `expense_type` (`expense_type`),
  KEY `expense_date` (`expense_date`),
  KEY `expense_amount` (`expense_amount`),
  KEY `expense_description` (`expense_description`(255)),
  KEY `expense_reason` (`expense_reason`),
  KEY `expense_note` (`expense_note`(255)),
  KEY `expense_image_id` (`expense_image_id`),
  CONSTRAINT `phppos_expenses_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_expenses_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_expenses_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `phppos_expenses_categories` (`id`),
  CONSTRAINT `phppos_expenses_ibfk_4` FOREIGN KEY (`approved_employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_expenses_ibfk_5` FOREIGN KEY (`expense_image_id`) REFERENCES `phppos_app_files` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_expenses`
--

LOCK TABLES `phppos_expenses` WRITE;
/*!40000 ALTER TABLE `phppos_expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_expenses_categories`
--

DROP TABLE IF EXISTS `phppos_expenses_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_expenses_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(1) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`),
  KEY `phppos_expenses_categories_ibfk_1` (`parent_id`),
  KEY `name` (`name`),
  CONSTRAINT `phppos_expenses_categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `phppos_expenses_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_expenses_categories`
--

LOCK TABLES `phppos_expenses_categories` WRITE;
/*!40000 ALTER TABLE `phppos_expenses_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_expenses_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_expenses_files`
--

DROP TABLE IF EXISTS `phppos_expenses_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_expenses_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `expense_id` (`expense_id`),
  CONSTRAINT `phppos_expenses_files_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `phppos_app_files` (`file_id`),
  CONSTRAINT `phppos_expenses_files_ibfk_2` FOREIGN KEY (`expense_id`) REFERENCES `phppos_expenses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_expenses_files`
--

LOCK TABLES `phppos_expenses_files` WRITE;
/*!40000 ALTER TABLE `phppos_expenses_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_expenses_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_facturas`
--

DROP TABLE IF EXISTS `phppos_facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL COMMENT 'ID de la venta en PHP POS',
  `api_id` varchar(50) NOT NULL COMMENT 'ID interno de la factura en la API',
  `cuf` varchar(128) NOT NULL,
  `numero_factura` varchar(50) NOT NULL,
  `nit` varchar(20) DEFAULT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `monto_total` decimal(12,2) NOT NULL,
  `estado` enum('VALIDO','ANULADA','REVERTIDA') NOT NULL DEFAULT 'VALIDO',
  `email` varchar(120) DEFAULT NULL,
  `pdf_generado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_sale` (`sale_id`),
  CONSTRAINT `fk_facturas_sales` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_facturas`
--

LOCK TABLES `phppos_facturas` WRITE;
/*!40000 ALTER TABLE `phppos_facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_giftcards`
--

DROP TABLE IF EXISTS `phppos_giftcards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_giftcards` (
  `giftcard_id` int(11) NOT NULL AUTO_INCREMENT,
  `giftcard_number` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `value` decimal(23,10) NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `inactive` int(1) NOT NULL DEFAULT 0,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `integrated_gift_card` int(1) NOT NULL DEFAULT 0,
  `integrated_auth_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`giftcard_id`),
  UNIQUE KEY `giftcard_number` (`giftcard_number`),
  KEY `deleted` (`deleted`),
  KEY `phppos_giftcards_ibfk_1` (`customer_id`),
  KEY `description` (`description`(255)),
  CONSTRAINT `phppos_giftcards_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `phppos_customers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_giftcards`
--

LOCK TABLES `phppos_giftcards` WRITE;
/*!40000 ALTER TABLE `phppos_giftcards` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_giftcards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_giftcards_log`
--

DROP TABLE IF EXISTS `phppos_giftcards_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_giftcards_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `giftcard_id` int(11) NOT NULL,
  `transaction_amount` decimal(23,10) NOT NULL,
  `log_message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_giftcards_log_ibfk_1` (`giftcard_id`),
  CONSTRAINT `phppos_giftcards_log_ibfk_1` FOREIGN KEY (`giftcard_id`) REFERENCES `phppos_giftcards` (`giftcard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_giftcards_log`
--

LOCK TABLES `phppos_giftcards_log` WRITE;
/*!40000 ALTER TABLE `phppos_giftcards_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_giftcards_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_grid_hidden_categories`
--

DROP TABLE IF EXISTS `phppos_grid_hidden_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_grid_hidden_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_grid` (`category_id`,`location_id`),
  KEY `phppos_grid_hidden_categories_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_grid_hidden_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `phppos_categories` (`id`),
  CONSTRAINT `phppos_grid_hidden_categories_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_grid_hidden_categories`
--

LOCK TABLES `phppos_grid_hidden_categories` WRITE;
/*!40000 ALTER TABLE `phppos_grid_hidden_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_grid_hidden_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_grid_hidden_item_kits`
--

DROP TABLE IF EXISTS `phppos_grid_hidden_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_grid_hidden_item_kits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_kit_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_grid` (`item_kit_id`,`location_id`),
  KEY `phppos_grid_hidden_item_kits_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_grid_hidden_item_kits_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_grid_hidden_item_kits_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_grid_hidden_item_kits`
--

LOCK TABLES `phppos_grid_hidden_item_kits` WRITE;
/*!40000 ALTER TABLE `phppos_grid_hidden_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_grid_hidden_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_grid_hidden_items`
--

DROP TABLE IF EXISTS `phppos_grid_hidden_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_grid_hidden_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_grid` (`item_id`,`location_id`),
  KEY `phppos_grid_hidden_items_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_grid_hidden_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_grid_hidden_items_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_grid_hidden_items`
--

LOCK TABLES `phppos_grid_hidden_items` WRITE;
/*!40000 ALTER TABLE `phppos_grid_hidden_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_grid_hidden_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_grid_hidden_tags`
--

DROP TABLE IF EXISTS `phppos_grid_hidden_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_grid_hidden_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_grid` (`tag_id`,`location_id`),
  KEY `phppos_grid_hidden_tags_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_grid_hidden_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `phppos_tags` (`id`),
  CONSTRAINT `phppos_grid_hidden_tags_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_grid_hidden_tags`
--

LOCK TABLES `phppos_grid_hidden_tags` WRITE;
/*!40000 ALTER TABLE `phppos_grid_hidden_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_grid_hidden_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_inventory`
--

DROP TABLE IF EXISTS `phppos_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_inventory` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_items` int(11) NOT NULL DEFAULT 0,
  `item_variation_id` int(10) DEFAULT NULL,
  `trans_user` int(11) NOT NULL DEFAULT 0,
  `trans_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `trans_comment` text NOT NULL,
  `trans_inventory` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `location_id` int(11) NOT NULL,
  `trans_current_quantity` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `phppos_inventory_ibfk_1` (`trans_items`),
  KEY `phppos_inventory_ibfk_2` (`trans_user`),
  KEY `location_id` (`location_id`),
  KEY `trans_date` (`trans_date`,`trans_inventory`,`location_id`),
  KEY `phppos_inventory_ibfk_4` (`item_variation_id`),
  KEY `phppos_inventory_custom` (`trans_items`,`location_id`,`trans_date`,`item_variation_id`,`trans_id`),
  CONSTRAINT `phppos_inventory_ibfk_1` FOREIGN KEY (`trans_items`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_inventory_ibfk_2` FOREIGN KEY (`trans_user`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_inventory_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_inventory_ibfk_4` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_inventory`
--

LOCK TABLES `phppos_inventory` WRITE;
/*!40000 ALTER TABLE `phppos_inventory` DISABLE KEYS */;
INSERT INTO `phppos_inventory` VALUES (1,1,NULL,1,'2025-05-08 21:00:14','',500.0000000000,1,500.0000000000),(2,1,NULL,1,'2025-05-08 21:02:24','POS 1',-1.0000000000,1,499.0000000000),(3,1,NULL,1,'2025-05-09 15:07:37','POS 2',-1.0000000000,1,498.0000000000),(4,1,NULL,1,'2025-05-09 15:24:04','POS 3',-1.0000000000,1,497.0000000000),(5,1,NULL,1,'2025-05-09 15:25:27','POS 4',-1.0000000000,1,496.0000000000),(6,1,NULL,1,'2025-05-09 15:26:09','POS 5',-1.0000000000,1,495.0000000000),(7,1,NULL,1,'2025-05-09 15:30:15','POS 6',-1.0000000000,1,494.0000000000),(8,1,NULL,1,'2025-05-09 15:40:36','POS 7',-1.0000000000,1,493.0000000000),(9,1,NULL,1,'2025-05-09 15:47:07','POS 8',-1.0000000000,1,492.0000000000),(10,1,NULL,1,'2025-05-09 15:54:54','POS 9',-1.0000000000,1,491.0000000000),(11,1,NULL,1,'2025-05-09 16:48:02','POS 10',-1.0000000000,1,490.0000000000),(12,1,NULL,1,'2025-05-09 17:41:03','POS 11',-1.0000000000,1,489.0000000000),(13,1,NULL,1,'2025-05-09 17:50:08','POS 12',-2.0000000000,1,487.0000000000),(14,1,NULL,1,'2025-05-09 17:55:34','POS 13',-1.0000000000,1,486.0000000000),(15,1,NULL,1,'2025-05-09 18:11:36','POS 14',-1.0000000000,1,485.0000000000),(16,1,NULL,1,'2025-05-09 18:18:00','POS 15',-5.0000000000,1,480.0000000000),(17,1,NULL,1,'2025-05-09 18:22:19','POS 16',-1.0000000000,1,479.0000000000),(18,1,NULL,1,'2025-05-09 18:29:44','POS 17',-2.0000000000,1,477.0000000000),(19,1,NULL,1,'2025-05-09 18:32:53','POS 18',-1.0000000000,1,476.0000000000),(20,1,NULL,1,'2025-05-09 18:37:34','POS 19',-1.0000000000,1,475.0000000000),(21,1,NULL,1,'2025-05-09 18:41:19','POS 20',-1.0000000000,1,474.0000000000),(22,1,NULL,1,'2025-05-09 19:07:20','POS 21',-1.0000000000,1,473.0000000000),(23,1,NULL,1,'2025-05-09 19:17:22','POS 22',-1.0000000000,1,472.0000000000),(24,1,NULL,1,'2025-05-09 19:38:28','POS 23',-1.0000000000,1,471.0000000000),(25,1,NULL,1,'2025-05-09 20:02:27','POS 24',-1.0000000000,1,470.0000000000),(26,1,NULL,1,'2025-05-09 20:07:28','POS 25',-1.0000000000,1,469.0000000000),(27,1,NULL,1,'2025-05-09 20:17:31','POS 26',-5.0000000000,1,464.0000000000),(28,1,NULL,1,'2025-05-10 12:15:56','POS 27',-1.0000000000,1,463.0000000000),(29,1,NULL,1,'2025-05-10 12:48:38','POS 28',-1.0000000000,1,462.0000000000),(30,1,NULL,1,'2025-05-10 12:49:32','POS 29',-1.0000000000,1,461.0000000000),(31,1,NULL,1,'2025-05-10 12:57:30','POS 30',-1.0000000000,1,460.0000000000),(32,1,NULL,1,'2025-05-10 13:13:30','POS 31',-1.0000000000,1,459.0000000000),(33,1,NULL,1,'2025-05-10 13:26:27','POS 32',-1.0000000000,1,458.0000000000),(34,1,NULL,1,'2025-05-10 16:48:30','POS 33',-1.0000000000,1,457.0000000000),(35,1,NULL,1,'2025-05-12 12:45:13','POS 34',-1.0000000000,1,456.0000000000),(36,1,NULL,1,'2025-05-12 14:07:33','POS 35',-1.0000000000,1,455.0000000000),(37,1,NULL,1,'2025-05-12 14:08:57','POS 36',-1.0000000000,1,454.0000000000),(38,1,NULL,1,'2025-05-12 14:10:52','POS 37',-1.0000000000,1,453.0000000000),(39,1,NULL,1,'2025-05-12 15:38:48','POS 38',-1.0000000000,1,452.0000000000),(40,1,NULL,1,'2025-05-12 15:40:40','POS 39',-1.0000000000,1,451.0000000000),(41,1,NULL,1,'2025-05-12 15:42:50','POS 40',-1.0000000000,1,450.0000000000),(42,1,NULL,1,'2025-05-12 16:13:34','POS 41',-1.0000000000,1,449.0000000000),(43,1,NULL,1,'2025-05-12 16:26:13','POS 42',-1.0000000000,1,448.0000000000),(44,1,NULL,1,'2025-05-12 16:27:21','POS 43',-1.0000000000,1,447.0000000000),(45,1,NULL,1,'2025-05-12 16:29:39','POS 44',-1.0000000000,1,446.0000000000),(46,1,NULL,1,'2025-05-12 16:34:34','POS 45',-1.0000000000,1,445.0000000000),(47,1,NULL,1,'2025-05-12 16:41:08','POS 46',-1.0000000000,1,444.0000000000),(48,1,NULL,1,'2025-05-12 16:53:36','POS 47',-1.0000000000,1,443.0000000000),(49,1,NULL,1,'2025-05-12 17:38:22','POS 48',-1.0000000000,1,442.0000000000),(50,1,NULL,1,'2025-05-12 19:09:24','POS 49',-1.0000000000,1,441.0000000000),(51,1,NULL,1,'2025-05-12 19:14:11','POS 50',-1.0000000000,1,440.0000000000),(52,1,NULL,1,'2025-05-12 19:17:30','POS 51',-1.0000000000,1,439.0000000000),(53,1,NULL,1,'2025-05-12 19:18:51','POS 52',-1.0000000000,1,438.0000000000),(54,1,NULL,1,'2025-05-12 19:19:58','POS 53',-1.0000000000,1,437.0000000000),(55,1,NULL,1,'2025-05-12 19:44:48','POS 54',-1.0000000000,1,436.0000000000),(56,1,NULL,1,'2025-05-12 19:46:48','POS 55',-1.0000000000,1,435.0000000000),(57,1,NULL,1,'2025-05-12 19:52:37','POS 56',-1.0000000000,1,434.0000000000),(58,1,NULL,1,'2025-05-12 20:09:10','POS 57',-4.0000000000,1,430.0000000000),(59,1,NULL,1,'2025-05-12 20:12:07','POS 58',-1.0000000000,1,429.0000000000),(60,2,NULL,1,'2025-05-12 20:24:56','',900.0000000000,1,900.0000000000),(61,1,NULL,1,'2025-05-12 20:27:12','POS 59',-5.0000000000,1,424.0000000000),(62,2,NULL,1,'2025-05-12 20:27:12','POS 59',-6.0000000000,1,894.0000000000),(63,2,NULL,1,'2025-05-12 20:35:51','POS 60',-1.0000000000,1,893.0000000000),(64,2,NULL,1,'2025-05-12 20:39:06','POS 61',-1.0000000000,1,892.0000000000),(65,2,NULL,1,'2025-05-12 20:40:08','POS 62',-1.0000000000,1,891.0000000000),(66,2,NULL,1,'2025-05-12 20:44:22','POS 63',-1.0000000000,1,890.0000000000),(67,2,NULL,1,'2025-05-12 20:45:44','POS 64',-1.0000000000,1,889.0000000000),(68,2,NULL,1,'2025-05-12 20:49:01','POS 65',-1.0000000000,1,888.0000000000),(69,1,NULL,1,'2025-05-12 20:50:25','POS 66',-1.0000000000,1,423.0000000000),(70,1,NULL,1,'2025-05-13 12:56:32','POS 67',-5.0000000000,1,418.0000000000),(71,2,NULL,1,'2025-05-13 12:56:32','POS 67',-1.0000000000,1,887.0000000000),(72,3,NULL,1,'2025-05-13 14:31:42','',400.0000000000,1,400.0000000000),(73,4,NULL,1,'2025-05-13 14:33:15','',600.0000000000,1,600.0000000000),(74,6,NULL,1,'2025-05-13 14:35:19','',800.0000000000,1,800.0000000000),(75,4,NULL,1,'2025-05-13 14:39:06','POS 68',-1.0000000000,1,599.0000000000),(76,2,NULL,1,'2025-05-13 14:39:06','POS 68',-1.0000000000,1,886.0000000000),(77,6,NULL,1,'2025-05-13 14:39:06','POS 68',-1.0000000000,1,799.0000000000),(78,4,NULL,1,'2025-05-13 15:36:51','POS 69',-1.0000000000,1,598.0000000000),(79,1,NULL,1,'2025-05-13 15:43:33','POS 70',-1.0000000000,1,417.0000000000),(80,2,NULL,1,'2025-05-13 15:51:21','POS 71',-1.0000000000,1,885.0000000000),(81,6,NULL,1,'2025-05-13 16:06:40','POS 72',-1.0000000000,1,798.0000000000),(82,2,NULL,1,'2025-05-13 16:55:48','POS 73',-1.0000000000,1,884.0000000000),(83,1,NULL,1,'2025-05-13 17:04:15','POS 74',-1.0000000000,1,416.0000000000),(84,1,NULL,1,'2025-05-13 17:09:37','POS 75',-1.0000000000,1,415.0000000000),(85,1,NULL,1,'2025-05-13 17:12:50','POS 76',-1.0000000000,1,414.0000000000),(86,4,NULL,1,'2025-05-13 18:54:23','POS 77',-1.0000000000,1,597.0000000000),(87,2,NULL,1,'2025-05-13 19:30:05','POS 78',-1.0000000000,1,883.0000000000),(88,1,NULL,1,'2025-05-13 19:58:36','POS 79',-1.0000000000,1,413.0000000000),(89,2,NULL,1,'2025-05-13 20:04:58','POS 80',-1.0000000000,1,882.0000000000),(90,6,NULL,1,'2025-05-13 20:34:08','POS 81',-1.0000000000,1,797.0000000000),(91,2,NULL,1,'2025-05-14 13:02:04','POS 82',-1.0000000000,1,881.0000000000),(92,2,NULL,1,'2025-05-14 15:17:21','POS 83',-1.0000000000,1,880.0000000000),(93,1,NULL,1,'2025-05-14 15:17:21','POS 83',-1.0000000000,1,412.0000000000),(94,2,NULL,1,'2025-05-15 12:29:50','POS 84',-1.0000000000,1,879.0000000000),(95,6,NULL,1,'2025-05-15 12:29:50','POS 84',-1.0000000000,1,796.0000000000),(96,1,NULL,1,'2025-05-15 14:34:23','POS 85',-1.0000000000,1,411.0000000000),(97,1,NULL,1,'2025-05-15 14:35:39','POS 86',-1.0000000000,1,410.0000000000),(98,2,NULL,1,'2025-05-15 14:37:21','POS 87',-1.0000000000,1,878.0000000000),(99,6,NULL,1,'2025-05-15 14:50:14','POS 88',-1.0000000000,1,795.0000000000),(100,1,NULL,1,'2025-05-15 14:55:13','POS 89',-1.0000000000,1,409.0000000000),(101,2,NULL,1,'2025-05-15 15:09:20','POS 90',-1.0000000000,1,877.0000000000),(102,6,NULL,1,'2025-05-15 16:13:05','POS 91',-1.0000000000,1,794.0000000000),(103,1,NULL,1,'2025-05-15 17:43:07','POS 92',-1.0000000000,1,408.0000000000),(104,1,NULL,1,'2025-05-15 18:34:45','POS 93',-1.0000000000,1,407.0000000000),(105,2,NULL,1,'2025-05-15 18:36:37','POS 94',-1.0000000000,1,876.0000000000),(106,6,NULL,1,'2025-05-15 18:51:27','POS 95',-1.0000000000,1,793.0000000000),(107,4,NULL,1,'2025-05-15 20:54:02','POS 96',-1.0000000000,1,596.0000000000),(108,6,NULL,1,'2025-05-15 20:54:02','POS 96',-1.0000000000,1,792.0000000000),(109,6,NULL,1,'2025-05-16 14:13:50','POS 97',-1.0000000000,1,791.0000000000),(110,6,NULL,1,'2025-05-16 14:48:24','POS 98',-1.0000000000,1,790.0000000000),(111,2,NULL,1,'2025-05-16 15:00:17','POS 99',-1.0000000000,1,875.0000000000),(112,6,NULL,1,'2025-05-16 19:56:19','POS 100',-1.0000000000,1,789.0000000000),(113,6,NULL,1,'2025-05-17 12:29:01','POS 101',-1.0000000000,1,788.0000000000),(114,2,NULL,1,'2025-05-17 15:39:18','POS 102',-1.0000000000,1,874.0000000000),(115,2,NULL,1,'2025-05-17 16:09:26','POS 103',-1.0000000000,1,873.0000000000),(116,1,NULL,1,'2025-05-19 14:52:31','POS 104',-1.0000000000,1,406.0000000000),(117,2,NULL,1,'2025-05-19 15:47:09','POS 105',-1.0000000000,1,872.0000000000),(118,1,NULL,1,'2025-05-19 15:47:09','POS 105',-1.0000000000,1,405.0000000000),(119,6,NULL,1,'2025-05-19 15:49:58','POS 106',-8.0000000000,1,780.0000000000),(120,4,NULL,1,'2025-05-19 15:49:58','POS 106',-2.0000000000,1,594.0000000000),(121,2,NULL,1,'2025-05-19 15:49:58','POS 106',-3.0000000000,1,869.0000000000),(122,1,NULL,1,'2025-05-19 15:49:58','POS 106',-6.0000000000,1,399.0000000000),(123,1,NULL,1,'2025-05-19 16:55:47','POS 107',-1.0000000000,1,398.0000000000),(124,6,NULL,1,'2025-05-19 16:55:47','POS 107',-1.0000000000,1,779.0000000000),(125,4,NULL,1,'2025-05-19 16:55:47','POS 107',-1.0000000000,1,593.0000000000),(126,4,NULL,1,'2025-05-20 20:30:42','POS 108',-1.0000000000,1,592.0000000000),(127,1,NULL,1,'2025-05-22 17:45:51','POS 109',-1.0000000000,1,397.0000000000),(128,4,NULL,1,'2025-05-22 18:10:29','POS 110',-1.0000000000,1,591.0000000000),(129,6,NULL,1,'2025-05-22 20:07:41','POS 111',-1.0000000000,1,778.0000000000),(130,4,NULL,1,'2025-05-23 15:21:50','POS 112',-1.0000000000,1,590.0000000000),(131,4,NULL,1,'2025-05-23 16:11:25','POS 112',1.0000000000,1,591.0000000000),(132,4,NULL,1,'2025-05-23 16:11:25','POS 112',-1.0000000000,1,590.0000000000),(133,4,NULL,1,'2025-05-23 16:12:04','POS 112',1.0000000000,1,591.0000000000),(134,4,NULL,1,'2025-05-23 16:12:04','POS 112',-1.0000000000,1,590.0000000000);
/*!40000 ALTER TABLE `phppos_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_inventory_counts`
--

DROP TABLE IF EXISTS `phppos_inventory_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_inventory_counts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `employee_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_inventory_counts_ibfk_1` (`employee_id`),
  KEY `phppos_inventory_counts_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_inventory_counts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_inventory_counts_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_inventory_counts`
--

LOCK TABLES `phppos_inventory_counts` WRITE;
/*!40000 ALTER TABLE `phppos_inventory_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_inventory_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_inventory_counts_items`
--

DROP TABLE IF EXISTS `phppos_inventory_counts_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_inventory_counts_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_counts_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_variation_id` int(10) DEFAULT NULL,
  `count` decimal(23,10) DEFAULT 0.0000000000,
  `actual_quantity` decimal(23,10) DEFAULT 0.0000000000,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_inventory_counts_items_ibfk_1` (`inventory_counts_id`),
  KEY `phppos_inventory_counts_items_ibfk_2` (`item_id`),
  KEY `inventory_counts_items_ibfk_3` (`item_variation_id`),
  CONSTRAINT `inventory_counts_items_ibfk_3` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_inventory_counts_items_ibfk_1` FOREIGN KEY (`inventory_counts_id`) REFERENCES `phppos_inventory_counts` (`id`),
  CONSTRAINT `phppos_inventory_counts_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_inventory_counts_items`
--

LOCK TABLES `phppos_inventory_counts_items` WRITE;
/*!40000 ALTER TABLE `phppos_inventory_counts_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_inventory_counts_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_attribute_values`
--

DROP TABLE IF EXISTS `phppos_item_attribute_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_attribute_values` (
  `item_id` int(10) NOT NULL,
  `attribute_value_id` int(10) NOT NULL,
  PRIMARY KEY (`attribute_value_id`,`item_id`),
  KEY `phppos_item_attribute_values_ibfk_1` (`item_id`),
  CONSTRAINT `phppos_item_attribute_values_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_item_attribute_values_ibfk_2` FOREIGN KEY (`attribute_value_id`) REFERENCES `phppos_attribute_values` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_attribute_values`
--

LOCK TABLES `phppos_item_attribute_values` WRITE;
/*!40000 ALTER TABLE `phppos_item_attribute_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_attribute_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_attributes`
--

DROP TABLE IF EXISTS `phppos_item_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_attributes` (
  `attribute_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  PRIMARY KEY (`attribute_id`,`item_id`),
  KEY `phppos_item_attributes_ibfk_1` (`item_id`),
  CONSTRAINT `phppos_item_attributes_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_item_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `phppos_attributes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_attributes`
--

LOCK TABLES `phppos_item_attributes` WRITE;
/*!40000 ALTER TABLE `phppos_item_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_images`
--

DROP TABLE IF EXISTS `phppos_item_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alt_text` varchar(255) NOT NULL DEFAULT '',
  `item_id` int(11) DEFAULT NULL,
  `item_variation_id` int(10) DEFAULT NULL,
  `ecommerce_image_id` varchar(255) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_item_images_ibfk_1` (`item_id`),
  KEY `phppos_item_images_ibfk_2` (`image_id`),
  KEY `phppos_item_images_ibfk_3` (`item_variation_id`),
  CONSTRAINT `phppos_item_images_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_item_images_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `phppos_app_files` (`file_id`),
  CONSTRAINT `phppos_item_images_ibfk_3` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_images`
--

LOCK TABLES `phppos_item_images` WRITE;
/*!40000 ALTER TABLE `phppos_item_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kit_images`
--

DROP TABLE IF EXISTS `phppos_item_kit_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kit_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alt_text` varchar(255) NOT NULL DEFAULT '',
  `item_kit_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_item_kit_images_ibfk_1` (`item_kit_id`),
  KEY `phppos_item_kit_images_ibfk_2` (`image_id`),
  CONSTRAINT `phppos_item_kit_images_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_item_kit_images_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `phppos_app_files` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kit_images`
--

LOCK TABLES `phppos_item_kit_images` WRITE;
/*!40000 ALTER TABLE `phppos_item_kit_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kit_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kit_item_kits`
--

DROP TABLE IF EXISTS `phppos_item_kit_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kit_item_kits` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_kit_id` int(11) NOT NULL,
  `item_kit_item_kit` int(11) NOT NULL,
  `quantity` decimal(23,10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_item_kit_item_kits_ibfk_1` (`item_kit_id`),
  KEY `phppos_item_kit_item_kits_ibfk_2` (`item_kit_item_kit`),
  CONSTRAINT `phppos_item_kit_item_kits_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_item_kit_item_kits_ibfk_2` FOREIGN KEY (`item_kit_item_kit`) REFERENCES `phppos_item_kits` (`item_kit_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kit_item_kits`
--

LOCK TABLES `phppos_item_kit_item_kits` WRITE;
/*!40000 ALTER TABLE `phppos_item_kit_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kit_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kit_items`
--

DROP TABLE IF EXISTS `phppos_item_kit_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kit_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_kit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_variation_id` int(10) DEFAULT NULL,
  `quantity` decimal(23,10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_item_kit_items_ibfk_1` (`item_kit_id`),
  KEY `phppos_item_kit_items_ibfk_2` (`item_id`),
  KEY `phppos_item_kit_items_ibfk_3` (`item_variation_id`),
  CONSTRAINT `phppos_item_kit_items_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_item_kit_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_item_kit_items_ibfk_3` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kit_items`
--

LOCK TABLES `phppos_item_kit_items` WRITE;
/*!40000 ALTER TABLE `phppos_item_kit_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kit_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kits`
--

DROP TABLE IF EXISTS `phppos_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kits` (
  `item_kit_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_kit_number` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `tax_included` int(1) NOT NULL DEFAULT 0,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  `override_default_tax` int(1) NOT NULL DEFAULT 0,
  `is_ebt_item` int(1) NOT NULL DEFAULT 0,
  `commission_percent` decimal(23,10) DEFAULT 0.0000000000,
  `commission_percent_type` varchar(255) DEFAULT '',
  `commission_fixed` decimal(23,10) DEFAULT 0.0000000000,
  `change_cost_price` int(1) NOT NULL DEFAULT 0,
  `disable_loyalty` int(1) NOT NULL DEFAULT 0,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `tax_class_id` int(10) DEFAULT NULL,
  `max_discount_percent` decimal(15,3) DEFAULT NULL,
  `max_edit_price` decimal(23,10) DEFAULT NULL,
  `min_edit_price` decimal(23,10) DEFAULT NULL,
  `custom_field_1_value` varchar(255) DEFAULT NULL,
  `custom_field_2_value` varchar(255) DEFAULT NULL,
  `custom_field_3_value` varchar(255) DEFAULT NULL,
  `custom_field_4_value` varchar(255) DEFAULT NULL,
  `custom_field_5_value` varchar(255) DEFAULT NULL,
  `custom_field_6_value` varchar(255) DEFAULT NULL,
  `custom_field_7_value` varchar(255) DEFAULT NULL,
  `custom_field_8_value` varchar(255) DEFAULT NULL,
  `custom_field_9_value` varchar(255) DEFAULT NULL,
  `custom_field_10_value` varchar(255) DEFAULT NULL,
  `required_age` int(10) DEFAULT NULL,
  `verify_age` int(1) NOT NULL DEFAULT 0,
  `allow_price_override_regardless_of_permissions` int(1) DEFAULT 0,
  `only_integer` int(1) NOT NULL DEFAULT 0,
  `is_barcoded` int(1) NOT NULL DEFAULT 1,
  `default_quantity` decimal(23,10) DEFAULT NULL,
  `disable_from_price_rules` int(1) DEFAULT 0,
  `main_image_id` int(10) DEFAULT NULL,
  `dynamic_pricing` int(1) NOT NULL DEFAULT 0,
  `info_popup` text DEFAULT NULL,
  `item_kit_inactive` int(1) DEFAULT 0,
  `barcode_name` varchar(255) NOT NULL DEFAULT '',
  `is_favorite` int(1) DEFAULT 0,
  `loyalty_multiplier` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`item_kit_id`),
  UNIQUE KEY `item_kit_number` (`item_kit_number`),
  UNIQUE KEY `product_id` (`product_id`),
  KEY `deleted` (`deleted`),
  KEY `phppos_item_kits_ibfk_1` (`category_id`),
  KEY `phppos_item_kits_ibfk_2` (`manufacturer_id`),
  KEY `name` (`name`),
  KEY `description` (`description`),
  KEY `cost_price` (`cost_price`),
  KEY `unit_price` (`unit_price`),
  KEY `phppos_item_kits_ibfk_3` (`tax_class_id`),
  KEY `custom_field_1_value` (`custom_field_1_value`),
  KEY `custom_field_2_value` (`custom_field_2_value`),
  KEY `custom_field_3_value` (`custom_field_3_value`),
  KEY `custom_field_4_value` (`custom_field_4_value`),
  KEY `custom_field_5_value` (`custom_field_5_value`),
  KEY `custom_field_6_value` (`custom_field_6_value`),
  KEY `custom_field_7_value` (`custom_field_7_value`),
  KEY `custom_field_8_value` (`custom_field_8_value`),
  KEY `custom_field_9_value` (`custom_field_9_value`),
  KEY `custom_field_10_value` (`custom_field_10_value`),
  KEY `verify_age` (`verify_age`),
  KEY `phppos_item_kits_ibfk_4` (`main_image_id`),
  KEY `item_kit_inactive_index` (`item_kit_inactive`),
  KEY `is_favorite_index` (`is_favorite`),
  CONSTRAINT `phppos_item_kits_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `phppos_categories` (`id`),
  CONSTRAINT `phppos_item_kits_ibfk_2` FOREIGN KEY (`manufacturer_id`) REFERENCES `phppos_manufacturers` (`id`),
  CONSTRAINT `phppos_item_kits_ibfk_3` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`),
  CONSTRAINT `phppos_item_kits_ibfk_4` FOREIGN KEY (`main_image_id`) REFERENCES `phppos_item_kit_images` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kits`
--

LOCK TABLES `phppos_item_kits` WRITE;
/*!40000 ALTER TABLE `phppos_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kits_modifiers`
--

DROP TABLE IF EXISTS `phppos_item_kits_modifiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kits_modifiers` (
  `item_kit_id` int(10) NOT NULL,
  `modifier_id` int(10) NOT NULL,
  PRIMARY KEY (`item_kit_id`,`modifier_id`),
  KEY `phppos_item_kits_modifiers_ibfk_1` (`modifier_id`),
  CONSTRAINT `phppos_item_kits_modifiers_ibfk_1` FOREIGN KEY (`modifier_id`) REFERENCES `phppos_modifiers` (`id`),
  CONSTRAINT `phppos_item_kits_modifiers_ibfk_2` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kits_modifiers`
--

LOCK TABLES `phppos_item_kits_modifiers` WRITE;
/*!40000 ALTER TABLE `phppos_item_kits_modifiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kits_modifiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kits_pricing_history`
--

DROP TABLE IF EXISTS `phppos_item_kits_pricing_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kits_pricing_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `on_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employee_id` int(11) NOT NULL,
  `item_kit_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_item_kits_pricing_history_ibfk_1` (`item_kit_id`),
  KEY `phppos_item_kits_pricing_history_ibfk_2` (`location_id`),
  KEY `phppos_item_kits_pricing_history_ibfk_3` (`employee_id`),
  CONSTRAINT `phppos_item_kits_pricing_history_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_item_kits_pricing_history_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_item_kits_pricing_history_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kits_pricing_history`
--

LOCK TABLES `phppos_item_kits_pricing_history` WRITE;
/*!40000 ALTER TABLE `phppos_item_kits_pricing_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kits_pricing_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kits_secondary_categories`
--

DROP TABLE IF EXISTS `phppos_item_kits_secondary_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kits_secondary_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_kit_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_kit_category` (`item_kit_id`,`category_id`),
  KEY `phppos_item_kits_secondary_categories_ibfk_1` (`item_kit_id`),
  KEY `phppos_item_kits_secondary_categories_ibfk_2` (`category_id`),
  CONSTRAINT `phppos_item_kits_secondary_categories_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_item_kits_secondary_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `phppos_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kits_secondary_categories`
--

LOCK TABLES `phppos_item_kits_secondary_categories` WRITE;
/*!40000 ALTER TABLE `phppos_item_kits_secondary_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kits_secondary_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kits_tags`
--

DROP TABLE IF EXISTS `phppos_item_kits_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kits_tags` (
  `item_kit_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`item_kit_id`,`tag_id`),
  KEY `phppos_item_kits_tags_ibfk_2` (`tag_id`),
  CONSTRAINT `phppos_item_kits_tags_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_item_kits_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `phppos_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kits_tags`
--

LOCK TABLES `phppos_item_kits_tags` WRITE;
/*!40000 ALTER TABLE `phppos_item_kits_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kits_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kits_taxes`
--

DROP TABLE IF EXISTS `phppos_item_kits_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kits_taxes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_kit_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tax` (`item_kit_id`,`name`,`percent`),
  CONSTRAINT `phppos_item_kits_taxes_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kits_taxes`
--

LOCK TABLES `phppos_item_kits_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_item_kits_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kits_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_kits_tier_prices`
--

DROP TABLE IF EXISTS `phppos_item_kits_tier_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_kits_tier_prices` (
  `tier_id` int(10) NOT NULL,
  `item_kit_id` int(10) NOT NULL,
  `unit_price` decimal(23,10) DEFAULT 0.0000000000,
  `percent_off` decimal(15,3) DEFAULT NULL,
  `cost_plus_percent` decimal(15,3) DEFAULT NULL,
  `cost_plus_fixed_amount` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`tier_id`,`item_kit_id`),
  KEY `phppos_item_kits_tier_prices_ibfk_2` (`item_kit_id`),
  CONSTRAINT `phppos_item_kits_tier_prices_ibfk_1` FOREIGN KEY (`tier_id`) REFERENCES `phppos_price_tiers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_item_kits_tier_prices_ibfk_2` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_kits_tier_prices`
--

LOCK TABLES `phppos_item_kits_tier_prices` WRITE;
/*!40000 ALTER TABLE `phppos_item_kits_tier_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_kits_tier_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_variation_attribute_values`
--

DROP TABLE IF EXISTS `phppos_item_variation_attribute_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_variation_attribute_values` (
  `attribute_value_id` int(10) NOT NULL,
  `item_variation_id` int(10) NOT NULL,
  PRIMARY KEY (`attribute_value_id`,`item_variation_id`),
  KEY `phppos_item_variation_attribute_values_ibfk_2` (`item_variation_id`),
  CONSTRAINT `phppos_item_variation_attribute_values_ibfk_1` FOREIGN KEY (`attribute_value_id`) REFERENCES `phppos_attribute_values` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_item_variation_attribute_values_ibfk_2` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_variation_attribute_values`
--

LOCK TABLES `phppos_item_variation_attribute_values` WRITE;
/*!40000 ALTER TABLE `phppos_item_variation_attribute_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_variation_attribute_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_item_variations`
--

DROP TABLE IF EXISTS `phppos_item_variations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_item_variations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ecommerce_variation_id` varchar(255) DEFAULT NULL,
  `ecommerce_variation_quantity` varchar(255) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `item_id` int(10) NOT NULL,
  `reorder_level` decimal(23,10) DEFAULT NULL,
  `replenish_level` decimal(23,10) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `item_number` varchar(255) DEFAULT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  `promo_price` decimal(23,10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `ecommerce_last_modified` timestamp NULL DEFAULT NULL,
  `is_ecommerce` int(1) NOT NULL DEFAULT 1,
  `ecommerce_inventory_item_id` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_number` (`item_number`),
  KEY `phppos_item_variations_ibfk_1` (`item_id`),
  KEY `phppos_item_variations_ibfk_2` (`ecommerce_variation_id`),
  KEY `ecommerce_inventory_item_id` (`ecommerce_inventory_item_id`),
  KEY `supplier_id` (`supplier_id`),
  FULLTEXT KEY `name_search` (`name`),
  CONSTRAINT `phppos_item_variations_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_item_variations_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_item_variations`
--

LOCK TABLES `phppos_item_variations` WRITE;
/*!40000 ALTER TABLE `phppos_item_variations` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_item_variations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items`
--

DROP TABLE IF EXISTS `phppos_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items` (
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `item_number` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `ecommerce_product_id` varchar(255) DEFAULT NULL,
  `ecommerce_product_quantity` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `size` varchar(255) NOT NULL DEFAULT '',
  `tax_included` int(1) NOT NULL DEFAULT 0,
  `cost_price` decimal(23,10) NOT NULL,
  `unit_price` decimal(23,10) NOT NULL,
  `promo_price` decimal(23,10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `reorder_level` decimal(23,10) DEFAULT NULL,
  `expire_days` int(10) DEFAULT NULL,
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `allow_alt_description` tinyint(1) NOT NULL,
  `is_serialized` tinyint(1) NOT NULL,
  `override_default_tax` int(1) NOT NULL DEFAULT 0,
  `is_ecommerce` int(1) DEFAULT 1,
  `is_service` int(1) NOT NULL DEFAULT 0,
  `is_ebt_item` int(1) NOT NULL DEFAULT 0,
  `commission_percent` decimal(23,10) DEFAULT 0.0000000000,
  `commission_percent_type` varchar(255) DEFAULT '',
  `commission_fixed` decimal(23,10) DEFAULT 0.0000000000,
  `change_cost_price` int(1) NOT NULL DEFAULT 0,
  `disable_loyalty` int(1) NOT NULL DEFAULT 0,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `ecommerce_last_modified` timestamp NULL DEFAULT NULL,
  `tax_class_id` int(10) DEFAULT NULL,
  `replenish_level` decimal(23,10) DEFAULT NULL,
  `system_item` int(1) NOT NULL DEFAULT 0,
  `max_discount_percent` decimal(15,3) DEFAULT NULL,
  `max_edit_price` decimal(23,10) DEFAULT NULL,
  `min_edit_price` decimal(23,10) DEFAULT NULL,
  `custom_field_1_value` varchar(255) DEFAULT NULL,
  `custom_field_2_value` varchar(255) DEFAULT NULL,
  `custom_field_3_value` varchar(255) DEFAULT NULL,
  `custom_field_4_value` varchar(255) DEFAULT NULL,
  `custom_field_5_value` varchar(255) DEFAULT NULL,
  `custom_field_6_value` varchar(255) DEFAULT NULL,
  `custom_field_7_value` varchar(255) DEFAULT NULL,
  `custom_field_8_value` varchar(255) DEFAULT NULL,
  `custom_field_9_value` varchar(255) DEFAULT NULL,
  `custom_field_10_value` varchar(255) DEFAULT NULL,
  `required_age` int(10) DEFAULT NULL,
  `verify_age` int(1) NOT NULL DEFAULT 0,
  `weight` decimal(23,10) DEFAULT NULL,
  `length` decimal(23,10) DEFAULT NULL,
  `width` decimal(23,10) DEFAULT NULL,
  `height` decimal(23,10) DEFAULT NULL,
  `ecommerce_shipping_class_id` varchar(255) DEFAULT NULL,
  `long_description` longtext NOT NULL,
  `allow_price_override_regardless_of_permissions` int(1) DEFAULT 0,
  `main_image_id` int(10) DEFAULT NULL,
  `only_integer` int(1) NOT NULL DEFAULT 0,
  `is_series_package` int(1) NOT NULL DEFAULT 0,
  `series_quantity` int(10) DEFAULT NULL,
  `series_days_to_use_within` int(10) DEFAULT NULL,
  `is_barcoded` int(1) NOT NULL DEFAULT 1,
  `default_quantity` decimal(23,10) DEFAULT NULL,
  `disable_from_price_rules` int(1) DEFAULT 0,
  `last_edited` timestamp NULL DEFAULT NULL,
  `info_popup` text DEFAULT NULL,
  `item_inactive` int(1) DEFAULT 0,
  `barcode_name` varchar(255) NOT NULL DEFAULT '',
  `tags` varchar(255) DEFAULT '',
  `is_favorite` int(1) DEFAULT 0,
  `loyalty_multiplier` decimal(23,10) DEFAULT NULL,
  `ecommerce_inventory_item_id` varchar(255) DEFAULT NULL,
  `weight_unit` varchar(255) DEFAULT NULL,
  `is_recurring` int(1) DEFAULT 0,
  `startup_cost` decimal(23,10) DEFAULT 0.0000000000,
  `prorated` int(1) DEFAULT 0,
  `interval` varchar(255) DEFAULT NULL,
  `weekday` int(1) DEFAULT NULL,
  `day_number` int(10) DEFAULT NULL,
  `month` int(10) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `shopify_item_level_inventory_policy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_number` (`item_number`),
  UNIQUE KEY `product_id` (`product_id`),
  KEY `phppos_items_ibfk_1` (`supplier_id`),
  KEY `deleted` (`deleted`),
  KEY `phppos_items_ibfk_3` (`category_id`),
  KEY `phppos_items_ibfk_4` (`manufacturer_id`),
  KEY `phppos_items_ibfk_5` (`ecommerce_product_id`),
  KEY `description` (`description`(255)),
  KEY `size` (`size`),
  KEY `reorder_level` (`reorder_level`),
  KEY `cost_price` (`cost_price`),
  KEY `unit_price` (`unit_price`),
  KEY `promo_price` (`promo_price`),
  KEY `last_modified` (`last_modified`),
  KEY `name` (`name`),
  KEY `phppos_items_ibfk_6` (`tax_class_id`),
  KEY `deleted_system_item` (`deleted`,`system_item`),
  KEY `custom_field_1_value` (`custom_field_1_value`),
  KEY `custom_field_2_value` (`custom_field_2_value`),
  KEY `custom_field_3_value` (`custom_field_3_value`),
  KEY `custom_field_4_value` (`custom_field_4_value`),
  KEY `custom_field_5_value` (`custom_field_5_value`),
  KEY `custom_field_6_value` (`custom_field_6_value`),
  KEY `custom_field_7_value` (`custom_field_7_value`),
  KEY `custom_field_8_value` (`custom_field_8_value`),
  KEY `custom_field_9_value` (`custom_field_9_value`),
  KEY `custom_field_10_value` (`custom_field_10_value`),
  KEY `verify_age` (`verify_age`),
  KEY `phppos_items_ibfk_7` (`main_image_id`),
  KEY `item_inactive_index` (`item_inactive`),
  KEY `tags` (`tags`),
  KEY `is_favorite_index` (`is_favorite`),
  KEY `ecommerce_product_id` (`ecommerce_product_id`),
  KEY `ecommerce_inventory_item_id` (`ecommerce_inventory_item_id`),
  FULLTEXT KEY `full_search` (`name`,`item_number`,`product_id`,`description`),
  FULLTEXT KEY `name_search` (`name`),
  FULLTEXT KEY `item_number_search` (`item_number`),
  FULLTEXT KEY `product_id_search` (`product_id`),
  FULLTEXT KEY `description_search` (`description`),
  FULLTEXT KEY `size_search` (`size`),
  FULLTEXT KEY `custom_field_1_value_search` (`custom_field_1_value`),
  FULLTEXT KEY `custom_field_2_value_search` (`custom_field_2_value`),
  FULLTEXT KEY `custom_field_3_value_search` (`custom_field_3_value`),
  FULLTEXT KEY `custom_field_4_value_search` (`custom_field_4_value`),
  FULLTEXT KEY `custom_field_5_value_search` (`custom_field_5_value`),
  FULLTEXT KEY `custom_field_6_value_search` (`custom_field_6_value`),
  FULLTEXT KEY `custom_field_7_value_search` (`custom_field_7_value`),
  FULLTEXT KEY `custom_field_8_value_search` (`custom_field_8_value`),
  FULLTEXT KEY `custom_field_9_value_search` (`custom_field_9_value`),
  FULLTEXT KEY `custom_field_10_value_search` (`custom_field_10_value`),
  CONSTRAINT `phppos_items_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`),
  CONSTRAINT `phppos_items_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `phppos_categories` (`id`),
  CONSTRAINT `phppos_items_ibfk_4` FOREIGN KEY (`manufacturer_id`) REFERENCES `phppos_manufacturers` (`id`),
  CONSTRAINT `phppos_items_ibfk_6` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`),
  CONSTRAINT `phppos_items_ibfk_7` FOREIGN KEY (`main_image_id`) REFERENCES `phppos_app_files` (`file_id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items`
--

LOCK TABLES `phppos_items` WRITE;
/*!40000 ALTER TABLE `phppos_items` DISABLE KEYS */;
INSERT INTO `phppos_items` VALUES ('Cafe',1,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,5.0000000000,10.0000000000,NULL,NULL,NULL,NULL,NULL,1,0,0,0,0,0,0,NULL,'',NULL,0,0,0,'2025-05-22 17:45:51',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,0,0,NULL,NULL,1,NULL,0,'2025-05-08 21:00:04',NULL,0,'','',0,NULL,NULL,NULL,0,0.0000000000,0,NULL,NULL,NULL,NULL,NULL,NULL),('Leche',2,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,8.0000000000,12.0000000000,NULL,NULL,NULL,NULL,NULL,2,0,0,0,0,0,0,NULL,'',NULL,0,0,0,'2025-05-19 15:49:58',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,0,0,NULL,NULL,1,NULL,0,'2025-05-12 20:24:39',NULL,0,'','',0,NULL,NULL,NULL,0,0.0000000000,0,NULL,NULL,NULL,NULL,NULL,NULL),('Mouse inalambrico',3,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,23.0000000000,27.0000000000,NULL,NULL,NULL,NULL,NULL,3,0,0,0,0,0,0,NULL,'',NULL,0,0,0,'2025-05-13 14:31:42',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,0,0,NULL,NULL,1,NULL,0,'2025-05-13 14:31:32',NULL,0,'','',0,NULL,NULL,NULL,0,0.0000000000,0,NULL,NULL,NULL,NULL,NULL,NULL),('Arroz',4,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,45.0000000000,50.0000000000,NULL,NULL,NULL,NULL,NULL,4,0,0,0,0,0,0,NULL,'',NULL,0,0,0,'2025-05-23 16:12:04',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,0,0,NULL,NULL,1,NULL,0,'2025-05-13 14:33:07',NULL,0,'','',0,NULL,NULL,NULL,0,0.0000000000,0,NULL,NULL,NULL,NULL,NULL,NULL),('Arroz',4,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,0.0000000000,0.0000000000,NULL,NULL,NULL,NULL,NULL,5,0,0,0,0,0,0,NULL,'',NULL,0,0,1,'2025-05-13 14:34:10',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,0,0,NULL,NULL,1,NULL,0,NULL,NULL,0,'','',0,NULL,NULL,NULL,0,0.0000000000,0,NULL,NULL,NULL,NULL,NULL,NULL),('Azucar',4,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,67.0000000000,70.0000000000,NULL,NULL,NULL,NULL,NULL,6,0,0,0,0,0,0,NULL,'',NULL,0,0,0,'2025-05-22 20:07:41',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,0,0,NULL,NULL,1,NULL,0,'2025-05-13 14:35:10',NULL,0,'','',0,NULL,NULL,NULL,0,0.0000000000,0,NULL,NULL,NULL,NULL,NULL,NULL),('Discount',5,NULL,NULL,NULL,'Discount',NULL,NULL,'','',0,0.0000000000,0.0000000000,NULL,NULL,NULL,NULL,NULL,7,0,0,1,0,1,0,0.0000000000,'',0.0000000000,0,0,0,'2025-05-15 16:12:54',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,0,0,NULL,NULL,1,NULL,0,NULL,NULL,0,'','',0,NULL,NULL,NULL,0,0.0000000000,0,NULL,NULL,NULL,NULL,NULL,NULL),('Artículo de reparación',7,NULL,NULL,'Artículo de reparación','Artículo de reparación',NULL,NULL,'Artículo de reparación','',0,0.0000000000,0.0000000000,NULL,NULL,NULL,NULL,NULL,8,1,1,1,0,1,0,0.0000000000,'',0.0000000000,0,1,0,'2025-05-17 16:23:07',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'',0,NULL,0,0,NULL,NULL,1,NULL,0,NULL,NULL,0,'','',0,NULL,NULL,NULL,0,0.0000000000,0,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `phppos_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_modifiers`
--

DROP TABLE IF EXISTS `phppos_items_modifiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_modifiers` (
  `item_id` int(10) NOT NULL,
  `modifier_id` int(10) NOT NULL,
  PRIMARY KEY (`item_id`,`modifier_id`),
  KEY `phppos_items_modifiers_ibfk_1` (`modifier_id`),
  CONSTRAINT `phppos_items_modifiers_ibfk_1` FOREIGN KEY (`modifier_id`) REFERENCES `phppos_modifiers` (`id`),
  CONSTRAINT `phppos_items_modifiers_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_modifiers`
--

LOCK TABLES `phppos_items_modifiers` WRITE;
/*!40000 ALTER TABLE `phppos_items_modifiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_items_modifiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_pricing_history`
--

DROP TABLE IF EXISTS `phppos_items_pricing_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_pricing_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `on_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employee_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_variation_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_items_pricing_history_ibfk_1` (`item_id`),
  KEY `phppos_items_pricing_history_ibfk_2` (`item_variation_id`),
  KEY `phppos_items_pricing_history_ibfk_3` (`location_id`),
  KEY `phppos_items_pricing_history_ibfk_4` (`employee_id`),
  CONSTRAINT `phppos_items_pricing_history_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_items_pricing_history_ibfk_2` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_items_pricing_history_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_items_pricing_history_ibfk_4` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_pricing_history`
--

LOCK TABLES `phppos_items_pricing_history` WRITE;
/*!40000 ALTER TABLE `phppos_items_pricing_history` DISABLE KEYS */;
INSERT INTO `phppos_items_pricing_history` VALUES (1,'2025-05-08 21:00:04',1,1,NULL,NULL,10.0000000000,5.0000000000),(2,'2025-05-12 20:24:39',1,2,NULL,NULL,12.0000000000,8.0000000000),(3,'2025-05-13 14:31:32',1,3,NULL,NULL,27.0000000000,23.0000000000),(4,'2025-05-13 14:33:07',1,4,NULL,NULL,50.0000000000,45.0000000000),(5,'2025-05-13 14:35:10',1,6,NULL,NULL,70.0000000000,67.0000000000),(6,'2025-05-13 14:38:57',1,7,NULL,NULL,0.0000000000,0.0000000000),(7,'2025-05-16 17:51:25',1,8,NULL,NULL,0.0000000000,0.0000000000);
/*!40000 ALTER TABLE `phppos_items_pricing_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_quantity_units`
--

DROP TABLE IF EXISTS `phppos_items_quantity_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_quantity_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_quantity` decimal(23,10) NOT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  `quantity_unit_item_number` varchar(255) DEFAULT NULL,
  `default_for_sale` int(1) DEFAULT 0,
  `default_for_recv` int(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quantity_unit_item_number` (`quantity_unit_item_number`),
  KEY `phppos_items_quantity_units_ibfk_1` (`item_id`),
  KEY `default_for_sale` (`default_for_sale`),
  KEY `default_for_recv` (`default_for_recv`),
  CONSTRAINT `phppos_items_quantity_units_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_quantity_units`
--

LOCK TABLES `phppos_items_quantity_units` WRITE;
/*!40000 ALTER TABLE `phppos_items_quantity_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_items_quantity_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_secondary_categories`
--

DROP TABLE IF EXISTS `phppos_items_secondary_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_secondary_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_category` (`item_id`,`category_id`),
  KEY `phppos_items_secondary_categories_ibfk_1` (`item_id`),
  KEY `phppos_items_secondary_categories_ibfk_2` (`category_id`),
  CONSTRAINT `phppos_items_secondary_categories_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_items_secondary_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `phppos_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_secondary_categories`
--

LOCK TABLES `phppos_items_secondary_categories` WRITE;
/*!40000 ALTER TABLE `phppos_items_secondary_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_items_secondary_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_secondary_suppliers`
--

DROP TABLE IF EXISTS `phppos_items_secondary_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_secondary_suppliers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `phppos_items_secondary_suppliers_ibfk_2` (`supplier_id`),
  CONSTRAINT `phppos_items_secondary_suppliers_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_items_secondary_suppliers_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_secondary_suppliers`
--

LOCK TABLES `phppos_items_secondary_suppliers` WRITE;
/*!40000 ALTER TABLE `phppos_items_secondary_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_items_secondary_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_serial_numbers`
--

DROP TABLE IF EXISTS `phppos_items_serial_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_serial_numbers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) NOT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `serial_location_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `serial_number` (`serial_number`),
  KEY `phppos_items_serial_numbers_ibfk_1` (`item_id`),
  KEY `phppos_items_serial_numbers_ibfk_2` (`variation_id`),
  KEY `phppos_items_serial_numbers_ibfk_3` (`serial_location_id`),
  CONSTRAINT `phppos_items_serial_numbers_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_items_serial_numbers_ibfk_2` FOREIGN KEY (`variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_items_serial_numbers_ibfk_3` FOREIGN KEY (`serial_location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_serial_numbers`
--

LOCK TABLES `phppos_items_serial_numbers` WRITE;
/*!40000 ALTER TABLE `phppos_items_serial_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_items_serial_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_tags`
--

DROP TABLE IF EXISTS `phppos_items_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_tags` (
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`tag_id`),
  KEY `phppos_items_tags_ibfk_2` (`tag_id`),
  CONSTRAINT `phppos_items_tags_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_items_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `phppos_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_tags`
--

LOCK TABLES `phppos_items_tags` WRITE;
/*!40000 ALTER TABLE `phppos_items_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_items_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_taxes`
--

DROP TABLE IF EXISTS `phppos_items_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_taxes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tax` (`item_id`,`name`,`percent`),
  CONSTRAINT `phppos_items_taxes_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_taxes`
--

LOCK TABLES `phppos_items_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_items_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_items_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_items_tier_prices`
--

DROP TABLE IF EXISTS `phppos_items_tier_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_items_tier_prices` (
  `tier_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `unit_price` decimal(23,10) DEFAULT 0.0000000000,
  `percent_off` decimal(15,3) DEFAULT NULL,
  `cost_plus_percent` decimal(15,3) DEFAULT NULL,
  `cost_plus_fixed_amount` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`tier_id`,`item_id`),
  KEY `phppos_items_tier_prices_ibfk_2` (`item_id`),
  CONSTRAINT `phppos_items_tier_prices_ibfk_1` FOREIGN KEY (`tier_id`) REFERENCES `phppos_price_tiers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_items_tier_prices_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_items_tier_prices`
--

LOCK TABLES `phppos_items_tier_prices` WRITE;
/*!40000 ALTER TABLE `phppos_items_tier_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_items_tier_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_keys`
--

DROP TABLE IF EXISTS `phppos_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `key` varchar(40) NOT NULL,
  `key_ending` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `phppos_keys_user_id_fk` (`user_id`),
  CONSTRAINT `phppos_keys_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `phppos_employees` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_keys`
--

LOCK TABLES `phppos_keys` WRITE;
/*!40000 ALTER TABLE `phppos_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_limits`
--

DROP TABLE IF EXISTS `phppos_limits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(40) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uri` (`uri`),
  KEY `phppos_limits_api_key_fk` (`api_key`),
  CONSTRAINT `phppos_limits_api_key_fk` FOREIGN KEY (`api_key`) REFERENCES `phppos_keys` (`key`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_limits`
--

LOCK TABLES `phppos_limits` WRITE;
/*!40000 ALTER TABLE `phppos_limits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_limits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_ban_item_kits`
--

DROP TABLE IF EXISTS `phppos_location_ban_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_ban_item_kits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_kit_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_location` (`item_kit_id`,`location_id`) USING BTREE,
  KEY `location_id` (`location_id`),
  CONSTRAINT `phppos_location_ban_item_kits_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_location_ban_item_kits_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_ban_item_kits`
--

LOCK TABLES `phppos_location_ban_item_kits` WRITE;
/*!40000 ALTER TABLE `phppos_location_ban_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_ban_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_ban_items`
--

DROP TABLE IF EXISTS `phppos_location_ban_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_ban_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_location` (`item_id`,`location_id`) USING BTREE,
  KEY `location_id` (`location_id`),
  CONSTRAINT `phppos_location_ban_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_location_ban_items_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_ban_items`
--

LOCK TABLES `phppos_location_ban_items` WRITE;
/*!40000 ALTER TABLE `phppos_location_ban_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_ban_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_ban_tags`
--

DROP TABLE IF EXISTS `phppos_location_ban_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_ban_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_location` (`tag_id`,`location_id`) USING BTREE,
  KEY `location_id` (`location_id`),
  CONSTRAINT `phppos_location_ban_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `phppos_tags` (`id`),
  CONSTRAINT `phppos_location_ban_tags_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_ban_tags`
--

LOCK TABLES `phppos_location_ban_tags` WRITE;
/*!40000 ALTER TABLE `phppos_location_ban_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_ban_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_item_kits`
--

DROP TABLE IF EXISTS `phppos_location_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_item_kits` (
  `location_id` int(11) NOT NULL,
  `item_kit_id` int(11) NOT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  `override_default_tax` int(1) NOT NULL DEFAULT 0,
  `tax_class_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`location_id`,`item_kit_id`),
  KEY `phppos_location_item_kits_ibfk_2` (`item_kit_id`),
  KEY `phppos_location_item_kits_ibfk_3` (`tax_class_id`),
  CONSTRAINT `phppos_location_item_kits_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_location_item_kits_ibfk_2` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_location_item_kits_ibfk_3` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_item_kits`
--

LOCK TABLES `phppos_location_item_kits` WRITE;
/*!40000 ALTER TABLE `phppos_location_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_item_kits_taxes`
--

DROP TABLE IF EXISTS `phppos_location_item_kits_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_item_kits_taxes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `item_kit_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(16,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tax` (`location_id`,`item_kit_id`,`name`,`percent`),
  KEY `phppos_location_item_kits_taxes_ibfk_2` (`item_kit_id`),
  CONSTRAINT `phppos_location_item_kits_taxes_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_location_item_kits_taxes_ibfk_2` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_item_kits_taxes`
--

LOCK TABLES `phppos_location_item_kits_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_location_item_kits_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_item_kits_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_item_kits_tier_prices`
--

DROP TABLE IF EXISTS `phppos_location_item_kits_tier_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_item_kits_tier_prices` (
  `tier_id` int(10) NOT NULL,
  `item_kit_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `unit_price` decimal(23,10) DEFAULT 0.0000000000,
  `percent_off` decimal(15,3) DEFAULT NULL,
  `cost_plus_percent` decimal(15,3) DEFAULT NULL,
  `cost_plus_fixed_amount` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`tier_id`,`item_kit_id`,`location_id`),
  KEY `phppos_location_item_kits_tier_prices_ibfk_2` (`location_id`),
  KEY `phppos_location_item_kits_tier_prices_ibfk_3` (`item_kit_id`),
  CONSTRAINT `phppos_location_item_kits_tier_prices_ibfk_1` FOREIGN KEY (`tier_id`) REFERENCES `phppos_price_tiers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_location_item_kits_tier_prices_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_location_item_kits_tier_prices_ibfk_3` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_item_kits_tier_prices`
--

LOCK TABLES `phppos_location_item_kits_tier_prices` WRITE;
/*!40000 ALTER TABLE `phppos_location_item_kits_tier_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_item_kits_tier_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_item_variations`
--

DROP TABLE IF EXISTS `phppos_location_item_variations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_item_variations` (
  `item_variation_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `quantity` decimal(23,10) DEFAULT NULL,
  `reorder_level` decimal(23,10) DEFAULT NULL,
  `replenish_level` decimal(23,10) DEFAULT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `cost_price` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`item_variation_id`,`location_id`),
  KEY `phppos_item_attribute_location_values_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_item_attribute_location_values_ibfk_1` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_item_attribute_location_values_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_item_variations`
--

LOCK TABLES `phppos_location_item_variations` WRITE;
/*!40000 ALTER TABLE `phppos_location_item_variations` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_item_variations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_items`
--

DROP TABLE IF EXISTS `phppos_location_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_items` (
  `location_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL DEFAULT '',
  `cost_price` decimal(23,10) DEFAULT NULL,
  `unit_price` decimal(23,10) DEFAULT NULL,
  `promo_price` decimal(23,10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `quantity` decimal(23,10) DEFAULT 0.0000000000,
  `reorder_level` decimal(23,10) DEFAULT NULL,
  `override_default_tax` int(1) NOT NULL DEFAULT 0,
  `tax_class_id` int(10) DEFAULT NULL,
  `replenish_level` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`location_id`,`item_id`),
  KEY `phppos_location_items_ibfk_2` (`item_id`),
  KEY `quantity` (`quantity`),
  KEY `phppos_location_items_ibfk_3` (`tax_class_id`),
  CONSTRAINT `phppos_location_items_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_location_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_location_items_ibfk_3` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_items`
--

LOCK TABLES `phppos_location_items` WRITE;
/*!40000 ALTER TABLE `phppos_location_items` DISABLE KEYS */;
INSERT INTO `phppos_location_items` VALUES (1,1,'',NULL,NULL,NULL,NULL,NULL,397.0000000000,NULL,0,NULL,NULL),(1,2,'',NULL,NULL,NULL,NULL,NULL,869.0000000000,NULL,0,NULL,NULL),(1,3,'',NULL,NULL,NULL,NULL,NULL,400.0000000000,NULL,0,NULL,NULL),(1,4,'',NULL,NULL,NULL,NULL,NULL,590.0000000000,NULL,0,NULL,NULL),(1,6,'',NULL,NULL,NULL,NULL,NULL,778.0000000000,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `phppos_location_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_items_taxes`
--

DROP TABLE IF EXISTS `phppos_location_items_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_items_taxes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(16,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tax` (`location_id`,`item_id`,`name`,`percent`),
  KEY `phppos_location_items_taxes_ibfk_2` (`item_id`),
  CONSTRAINT `phppos_location_items_taxes_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_location_items_taxes_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_items_taxes`
--

LOCK TABLES `phppos_location_items_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_location_items_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_items_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_location_items_tier_prices`
--

DROP TABLE IF EXISTS `phppos_location_items_tier_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_location_items_tier_prices` (
  `tier_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `unit_price` decimal(23,10) DEFAULT 0.0000000000,
  `percent_off` decimal(15,3) DEFAULT NULL,
  `cost_plus_percent` decimal(15,3) DEFAULT NULL,
  `cost_plus_fixed_amount` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`tier_id`,`item_id`,`location_id`),
  KEY `phppos_location_items_tier_prices_ibfk_2` (`location_id`),
  KEY `phppos_location_items_tier_prices_ibfk_3` (`item_id`),
  CONSTRAINT `phppos_location_items_tier_prices_ibfk_1` FOREIGN KEY (`tier_id`) REFERENCES `phppos_price_tiers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phppos_location_items_tier_prices_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_location_items_tier_prices_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_location_items_tier_prices`
--

LOCK TABLES `phppos_location_items_tier_prices` WRITE;
/*!40000 ALTER TABLE `phppos_location_items_tier_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_location_items_tier_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_locations`
--

DROP TABLE IF EXISTS `phppos_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `company` text DEFAULT NULL,
  `website` text DEFAULT NULL,
  `company_logo` int(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `fax` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `cc_email` text DEFAULT NULL,
  `bcc_email` text DEFAULT NULL,
  `color` text DEFAULT NULL,
  `return_policy` text DEFAULT NULL,
  `receive_stock_alert` text DEFAULT NULL,
  `stock_alert_email` text DEFAULT NULL,
  `timezone` text DEFAULT NULL,
  `mailchimp_api_key` text DEFAULT NULL,
  `enable_credit_card_processing` text DEFAULT NULL,
  `credit_card_processor` text DEFAULT NULL,
  `hosted_checkout_merchant_id` text DEFAULT NULL,
  `hosted_checkout_merchant_password` text DEFAULT NULL,
  `emv_merchant_id` text DEFAULT NULL,
  `net_e_pay_server` text DEFAULT NULL,
  `listener_port` text DEFAULT NULL,
  `com_port` text DEFAULT NULL,
  `stripe_public` text DEFAULT NULL,
  `stripe_private` text DEFAULT NULL,
  `stripe_currency_code` text DEFAULT NULL,
  `braintree_merchant_id` text DEFAULT NULL,
  `braintree_public_key` text DEFAULT NULL,
  `braintree_private_key` text DEFAULT NULL,
  `default_tax_1_rate` text DEFAULT NULL,
  `default_tax_1_name` text DEFAULT NULL,
  `default_tax_2_rate` text DEFAULT NULL,
  `default_tax_2_name` text DEFAULT NULL,
  `default_tax_2_cumulative` text DEFAULT NULL,
  `default_tax_3_rate` text DEFAULT NULL,
  `default_tax_3_name` text DEFAULT NULL,
  `default_tax_4_rate` text DEFAULT NULL,
  `default_tax_4_name` text DEFAULT NULL,
  `default_tax_5_rate` text DEFAULT NULL,
  `default_tax_5_name` text DEFAULT NULL,
  `deleted` int(1) DEFAULT 0,
  `secure_device_override_emv` varchar(255) NOT NULL DEFAULT '',
  `secure_device_override_non_emv` varchar(255) NOT NULL DEFAULT '',
  `tax_class_id` int(10) DEFAULT NULL,
  `ebt_integrated` int(1) NOT NULL DEFAULT 0,
  `integrated_gift_cards` int(1) NOT NULL DEFAULT 0,
  `square_currency_code` varchar(255) NOT NULL DEFAULT 'USD',
  `square_location_id` varchar(255) NOT NULL DEFAULT '',
  `square_currency_multiplier` varchar(255) NOT NULL DEFAULT '100',
  `email_sales_email` varchar(255) DEFAULT NULL,
  `email_receivings_email` varchar(255) DEFAULT NULL,
  `stock_alerts_just_order_level` int(1) DEFAULT 0,
  `platformly_api_key` text DEFAULT NULL,
  `platformly_project_id` text DEFAULT NULL,
  `tax_id` varchar(255) NOT NULL DEFAULT '',
  `disable_markup_markdown` text DEFAULT NULL,
  `card_connect_mid` varchar(255) DEFAULT NULL,
  `card_connect_rest_username` varchar(255) DEFAULT NULL,
  `card_connect_rest_password` varchar(255) DEFAULT NULL,
  `default_mailchimp_lists` varchar(255) NOT NULL DEFAULT '',
  `twilio_sid` varchar(255) DEFAULT NULL,
  `twilio_token` varchar(255) DEFAULT NULL,
  `twilio_sms_from` varchar(255) DEFAULT NULL,
  `auto_reports_email` varchar(255) NOT NULL DEFAULT '',
  `auto_reports_email_time` time DEFAULT NULL,
  `auto_reports_day` varchar(255) NOT NULL DEFAULT 'previous_day',
  `disable_confirmation_option_for_emv_credit_card` int(1) NOT NULL DEFAULT 0,
  `blockchyp_api_key` varchar(255) DEFAULT NULL,
  `blockchyp_bearer_token` varchar(255) DEFAULT NULL,
  `blockchyp_signing_key` varchar(255) DEFAULT NULL,
  `blockchyp_test_mode` varchar(255) DEFAULT NULL,
  `sidekick_api_key` text DEFAULT NULL,
  `sidekick_auto_review` int(1) DEFAULT 0,
  `coreclear_merchant_id` varchar(255) DEFAULT NULL,
  `additional_appointment_note` text DEFAULT NULL,
  `send_sms_via_whatsapp` int(1) NOT NULL DEFAULT 0,
  `blockchyp_terms_and_conditions` text NOT NULL,
  `blockchyp_work_order_pre_auth` text NOT NULL,
  `blockchyp_work_order_post_auth` text NOT NULL,
  `blockchyp_prompt_for_loyalty` int(1) DEFAULT 0,
  `blockchyp_prompt_for_name` int(1) DEFAULT 0,
  `blockchyp_prompt_for_email` int(1) DEFAULT 0,
  `blockchyp_prompt_for_phone_number` int(1) DEFAULT 0,
  `blockchyp_ask_for_missing_info` int(1) DEFAULT 0,
  `square_access_token` text DEFAULT NULL,
  `square_refresh_token` text DEFAULT NULL,
  `square_access_token_expire` text DEFAULT NULL,
  `square_merchant_id` text DEFAULT NULL,
  `coreclear_mx_merchant_id` varchar(255) DEFAULT NULL,
  `coreclear_user` varchar(255) DEFAULT NULL,
  `coreclear_password` varchar(255) DEFAULT NULL,
  `coreclear_consumer_key` text DEFAULT NULL,
  `coreclear_secret_key` text DEFAULT NULL,
  `coreclear_authorization_key` text DEFAULT NULL,
  `coreclear_sandbox` tinyint(1) DEFAULT 0,
  `coreclear_allow_cards_on_file` tinyint(1) DEFAULT 0,
  `coreclear_authorization_key_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `tax_cap` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`location_id`),
  KEY `deleted` (`deleted`),
  KEY `phppos_locations_ibfk_1` (`company_logo`),
  KEY `name` (`name`(255)),
  KEY `address` (`address`(255)),
  KEY `phone` (`phone`(255)),
  KEY `email` (`email`(255)),
  KEY `phppos_locations_ibfk_2` (`tax_class_id`),
  CONSTRAINT `phppos_locations_ibfk_1` FOREIGN KEY (`company_logo`) REFERENCES `phppos_app_files` (`file_id`),
  CONSTRAINT `phppos_locations_ibfk_2` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_locations`
--

LOCK TABLES `phppos_locations` WRITE;
/*!40000 ALTER TABLE `phppos_locations` DISABLE KEYS */;
INSERT INTO `phppos_locations` VALUES (1,'Default',NULL,NULL,NULL,'123 Nowhere street','555-555-5555','','no-reply@example.com',NULL,NULL,NULL,NULL,'0','','America/New_York','','0',NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','0','','','','','','',0,'','',NULL,1,0,'USD','','100',NULL,NULL,0,NULL,NULL,'',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,'previous_day',0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,0,'','','',0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'2023-07-25 19:36:32',NULL);
/*!40000 ALTER TABLE `phppos_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_logs`
--

DROP TABLE IF EXISTS `phppos_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(40) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` enum('get','post','options','put','patch','delete') NOT NULL,
  `params` text DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_logs`
--

LOCK TABLES `phppos_logs` WRITE;
/*!40000 ALTER TABLE `phppos_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_manufacturers`
--

DROP TABLE IF EXISTS `phppos_manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_manufacturers`
--

LOCK TABLES `phppos_manufacturers` WRITE;
/*!40000 ALTER TABLE `phppos_manufacturers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_message_receiver`
--

DROP TABLE IF EXISTS `phppos_message_receiver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_message_receiver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_read` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `phppos_message_receiver_ibfk_2` (`receiver_id`),
  KEY `phppos_message_receiver_key_1` (`message_id`,`receiver_id`),
  CONSTRAINT `phppos_message_receiver_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `phppos_messages` (`id`),
  CONSTRAINT `phppos_message_receiver_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_message_receiver`
--

LOCK TABLES `phppos_message_receiver` WRITE;
/*!40000 ALTER TABLE `phppos_message_receiver` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_message_receiver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_messages`
--

DROP TABLE IF EXISTS `phppos_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `phppos_messages_ibfk_1` (`sender_id`),
  KEY `phppos_messages_key_1` (`deleted`,`created_at`,`id`),
  CONSTRAINT `phppos_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_messages`
--

LOCK TABLES `phppos_messages` WRITE;
/*!40000 ALTER TABLE `phppos_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_migrations`
--

DROP TABLE IF EXISTS `phppos_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_migrations`
--

LOCK TABLES `phppos_migrations` WRITE;
/*!40000 ALTER TABLE `phppos_migrations` DISABLE KEYS */;
INSERT INTO `phppos_migrations` VALUES (20230905146095);
/*!40000 ALTER TABLE `phppos_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_modifier_items`
--

DROP TABLE IF EXISTS `phppos_modifier_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_modifier_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sort_order` int(10) NOT NULL DEFAULT 0,
  `modifier_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost_price` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `unit_price` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `phppos_modifier_items_ibfk_1` (`modifier_id`),
  KEY `sort_index` (`deleted`,`modifier_id`,`sort_order`),
  CONSTRAINT `phppos_modifier_items_ibfk_1` FOREIGN KEY (`modifier_id`) REFERENCES `phppos_modifiers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_modifier_items`
--

LOCK TABLES `phppos_modifier_items` WRITE;
/*!40000 ALTER TABLE `phppos_modifier_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_modifier_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_modifiers`
--

DROP TABLE IF EXISTS `phppos_modifiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_modifiers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sort_order` int(10) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `sort_index` (`deleted`,`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_modifiers`
--

LOCK TABLES `phppos_modifiers` WRITE;
/*!40000 ALTER TABLE `phppos_modifiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_modifiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_modules`
--

DROP TABLE IF EXISTS `phppos_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `module_id` varchar(100) NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `desc_lang_key` (`desc_lang_key`),
  UNIQUE KEY `name_lang_key` (`name_lang_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_modules`
--

LOCK TABLES `phppos_modules` WRITE;
/*!40000 ALTER TABLE `phppos_modules` DISABLE KEYS */;
INSERT INTO `phppos_modules` VALUES ('module_appointments','module_appointments_desc',75,'ti-calendar','appointments'),('module_config','module_config_desc',100,'icon ti-settings','config'),('module_customers','module_customers_desc',10,'icon ti-user','customers'),('module_deliveries','module_deliveries_desc',71,'ion-android-car','deliveries'),('module_employees','module_employees_desc',80,'icon ti-id-badge','employees'),('module_expenses','module_expenses_desc',74,'icon ti-money','expenses'),('module_giftcards','module_giftcards_desc',90,'icon ti-credit-card','giftcards'),('module_invoices','module_invoices_desc',102,'ti-receipt','invoices'),('module_item_kits','module_item_kits_desc',30,'icon ti-harddrives','item_kits'),('module_items','module_items_desc',20,'icon ti-harddrive','items'),('module_locations','module_locations_desc',110,'icon ti-home','locations'),('module_messages','module_messages_desc',120,'icon ti-email','messages'),('module_price_rules','module_item_price_rules_desc',35,'ion-ios-pricetags-outline','price_rules'),('module_receivings','module_receivings_desc',60,'icon ti-cloud-down','receivings'),('module_reports','module_reports_desc',50,'icon ti-bar-chart','reports'),('module_sales','module_sales_desc',70,'icon ti-shopping-cart','sales'),('module_suppliers','module_suppliers_desc',40,'icon ti-download','suppliers'),('module_work_orders','module_work_orders_desc',72,'ion-hammer','work_orders');
/*!40000 ALTER TABLE `phppos_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_modules_actions`
--

DROP TABLE IF EXISTS `phppos_modules_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_modules_actions` (
  `action_id` varchar(100) NOT NULL,
  `module_id` varchar(100) NOT NULL,
  `action_name_key` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`action_id`,`module_id`),
  KEY `phppos_modules_actions_ibfk_1` (`module_id`),
  CONSTRAINT `phppos_modules_actions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_modules_actions`
--

LOCK TABLES `phppos_modules_actions` WRITE;
/*!40000 ALTER TABLE `phppos_modules_actions` DISABLE KEYS */;
INSERT INTO `phppos_modules_actions` VALUES ('add','appointments','appointments_add',240),('add','invoices','invoices_add',240),('add_remove_amounts_from_cash_drawer','sales','common_add_remove_amounts_from_cash_drawer',505),('add_update','customers','module_action_add_update',1),('add_update','deliveries','deliveries_add_update',240),('add_update','employees','module_action_add_update',130),('add_update','expenses','module_expenses_add_update',315),('add_update','giftcards','module_action_add_update',200),('add_update','item_kits','module_action_add_update',70),('add_update','items','module_action_add_update',40),('add_update','locations','module_action_add_update',240),('add_update','price_rules','module_action_add_update',400),('add_update','suppliers','module_action_add_update',100),('allow_customer_search_suggestions_for_sales','sales','sales_allow_customer_search_suggestions_for_sales',302),('allow_item_search_suggestions_for_receivings','receivings','receivings_allow_item_search_suggestions_for_receivings',301),('allow_item_search_suggestions_for_sales','sales','sales_allow_item_search_suggestions_for_sales',300),('allow_supplier_search_suggestions_for_suppliers','receivings','receivings_allow_supplier_search_suggestions_for_suppliers',303),('assign_all_locations','employees','module_action_assign_all_locations',151),('can_change_report_date','reports','reports_can_change_report_date',305),('can_delete_item_from_sale','sales','sales_can_delete_item_added_to_sale',308),('can_edit_inventory_comment','items','items_can_edit_inventory_comment',500),('can_lookup_last_receipt','sales','sales_can_lookup_last_receipt',503),('can_lookup_receipt','sales','sales_can_lookup_receipt',503),('change_sale_date','sales','sales_change_sale_date',184),('complete_sale','sales','sales_complete_sale',184),('complete_transfer','receivings','receivings_complete_transfer',184),('count_inventory','items','items_count_inventory',65),('delete','appointments','appointments_delete',250),('delete','customers','module_action_delete',20),('delete','deliveries','deliveries_delete',250),('delete','employees','module_action_delete',140),('delete','expenses','module_expenses_delete',330),('delete','giftcards','module_action_delete',210),('delete','invoices','invoices_delete',250),('delete','item_kits','module_action_delete',80),('delete','items','module_action_delete',50),('delete','locations','module_action_delete',250),('delete','price_rules','module_action_delete',405),('delete','suppliers','module_action_delete',110),('delete','work_orders','work_orders_delete',241),('delete_log_activity','work_orders','work_orders_delete_log_activity',244),('delete_receiving','receivings','module_action_delete_receiving',306),('delete_register_log','reports','common_delete_register_log',232),('delete_sale','sales','module_action_delete_sale',230),('delete_suspended_receiving','receivings','module_action_delete_suspended_receiving',181),('delete_suspended_sale','sales','module_action_delete_suspended_sale',181),('delete_taxes','receivings','module_action_delete_taxes',300),('delete_taxes','sales','module_action_delete_taxes',182),('edit','appointments','appointments_edit',245),('edit','deliveries','deliveries_edit',245),('edit','invoices','invoices_edit',245),('edit','work_orders','work_orders_edit',240),('edit_customer_points','customers','module_edit_customer_points',35),('edit_giftcard_value','giftcards','module_edit_giftcard_value',205),('edit_prices','item_kits','common_edit_prices',502),('edit_prices','items','common_edit_prices',501),('edit_profile','employees','common_edit_profile',155),('edit_quantity','items','items_edit_quantity',62),('edit_receiving','receivings','module_action_edit_receiving',303),('edit_register_log','reports','common_edit_register_log',231),('edit_sale','sales','module_edit_sale',190),('edit_sale_cost_price','sales','module_edit_sale_cost_price',175),('edit_sale_price','sales','module_edit_sale_price',170),('edit_store_account_balance','customers','customers_edit_store_account_balance',31),('edit_store_account_balance','suppliers','suppliers_edit_store_account_balance',130),('edit_suspended_sale','sales','sales_edit_suspended_sale',192),('edit_suspended_sale_data','sales','sales_edit_suspended_sale_data',300),('edit_taxes','receivings','module_edit_taxes',304),('edit_taxes','sales','module_edit_taxes',191),('edit_tier','customers','customers_edit_tier',45),('excel_export','customers','common_excel_export',40),('excel_export','employees','common_excel_export',160),('excel_export','giftcards','common_excel_export',225),('excel_export','item_kits','common_excel_export',95),('excel_export','items','common_excel_export',80),('excel_export','suppliers','common_excel_export',135),('export_to_sidekick','customers','customers_export_to_sidekick',46),('give_discount','receivings','module_give_discount',308),('give_discount','sales','module_give_discount',180),('manage_categories','deliveries','items_manage_categories',256),('manage_categories','expenses','items_manage_categories',316),('manage_categories','items','items_manage_categories',70),('manage_manufacturers','items','items_manage_manufacturers',76),('manage_statuses','deliveries','deliveries_manage_statuses',251),('manage_statuses','work_orders','work_orders_manage_statuses',243),('manage_tags','items','items_manage_tags',75),('process_returns','sales','config_process_returns',184),('receive_store_account_payment','receivings','common_receive_store_account_payment',260),('receive_store_account_payment','sales','common_receive_store_account_payment',255),('search','appointments','appointments_search',255),('search','customers','module_action_search_customers',30),('search','deliveries','deliveries_search',255),('search','employees','module_action_search_employees',150),('search','expenses','module_expenses_search',310),('search','giftcards','module_action_search_giftcards',220),('search','invoices','invoices_search',255),('search','item_kits','module_action_search_item_kits',90),('search','items','module_action_search_items',60),('search','locations','module_action_search_locations',260),('search','price_rules','module_action_search_price_rules',415),('search','sales','module_action_search_sales',235),('search','suppliers','module_action_search_suppliers',120),('search','work_orders','work_orders_search',242),('see_all_item_kits','item_kits','common_see_all_item_kits',505),('see_all_items','items','common_see_all_items',504),('see_cost_price','item_kits','module_see_cost_price',91),('see_cost_price','items','module_see_cost_price',61),('see_count_when_count_inventory','items','items_see_count_when_count_inventory',66),('see_item_quantity','items','items_see_item_quantity',64),('send_message','messages','employees_send_message',350),('send_transfer','receivings','receivings_send_transfer',185),('show_cost_price','reports','reports_show_cost_price',290),('show_profit','reports','reports_show_profit',280),('suspend_sale','sales','sales_suspend_sale',183),('view_all_employee_commissions','reports','reports_view_all_employee_commissions',107),('view_appointments','reports','reports_appointments',95),('view_categories','reports','reports_categories',100),('view_closeout','reports','reports_closeout',105),('view_commissions','reports','reports_commission',106),('view_customers','reports','reports_customers',120),('view_dashboard_stats','reports','reports_view_dashboard_stats',300),('view_deleted_sales','reports','reports_deleted_sales',130),('view_deliveries','reports','reports_deliveries',135),('view_discounts','reports','reports_discounts',140),('view_edit_transaction_history','sales','common_view_edit_transaction_history',400),('view_employees','reports','reports_employees',150),('view_expenses','reports','module_expenses_report',155),('view_giftcards','reports','reports_giftcards',160),('view_inventory_at_all_locations','items','common_view_inventory_at_all_locations',268),('view_inventory_at_all_locations','reports','reports_view_inventory_at_all_locations',300),('view_inventory_print_list','items','common_view_inventory_print_list',267),('view_inventory_reports','reports','reports_inventory_reports',170),('view_invoices_reports','reports','reports_invoices_reports',265),('view_item_kits','reports','module_item_kits',180),('view_items','reports','reports_items',190),('view_manufacturers','reports','reports_manufacturers',195),('view_payments','reports','reports_payments',200),('view_price_rules','reports','reports_price_rules',205),('view_profit_and_loss','reports','reports_profit_and_loss',210),('view_receivings','reports','reports_receivings',220),('view_register_log','reports','reports_register_log_title',230),('view_registers','reports','reports_registers',235),('view_sales','reports','reports_sales',240),('view_sales_generator','reports','reports_sales_generator',110),('view_store_account','reports','reports_store_account',250),('view_store_account_suppliers','reports','reports_store_account_suppliers',255),('view_suppliers','reports','reports_suppliers',260),('view_suspended_receipt','receivings','receivings_view_suspended_receipt',503),('view_suspended_receipt','sales','sales_view_suspended_receipt',503),('view_suspended_sales','reports','reports_suspended_sales',261),('view_tags','reports','common_tags',264),('view_taxes','reports','reports_taxes',270),('view_tiers','reports','reports_tiers',275),('view_timeclock','reports','employees_timeclock',280);
/*!40000 ALTER TABLE `phppos_modules_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_open_suspended_sales`
--

DROP TABLE IF EXISTS `phppos_open_suspended_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_open_suspended_sales` (
  `sale_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `register_id` int(11) NOT NULL,
  `expires` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `phppos_open_suspended_sales_ibfk_1` (`sale_id`),
  KEY `phppos_open_suspended_sales_ibfk_2` (`employee_id`),
  KEY `phppos_open_suspended_sales_ibfk_3` (`register_id`),
  CONSTRAINT `phppos_open_suspended_sales_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_open_suspended_sales_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_open_suspended_sales_ibfk_3` FOREIGN KEY (`register_id`) REFERENCES `phppos_registers` (`register_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_open_suspended_sales`
--

LOCK TABLES `phppos_open_suspended_sales` WRITE;
/*!40000 ALTER TABLE `phppos_open_suspended_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_open_suspended_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_people`
--

DROP TABLE IF EXISTS `phppos_people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_people` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `full_name` text NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `image_id` int(10) DEFAULT NULL,
  `person_id` int(10) NOT NULL AUTO_INCREMENT,
  `create_date` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  KEY `phppos_people_ibfk_1` (`image_id`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `email` (`email`),
  KEY `phone_number` (`phone_number`),
  KEY `full_name` (`full_name`(255)),
  CONSTRAINT `phppos_people_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `phppos_app_files` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_people`
--

LOCK TABLES `phppos_people` WRITE;
/*!40000 ALTER TABLE `phppos_people` DISABLE KEYS */;
INSERT INTO `phppos_people` VALUES ('John','Doe','John Doe','5555555555','no-reply@example.com','Address 1','','','','','','',NULL,1,NULL,NULL,NULL),('leo','Rivera','leo Rivera','','','','','','','','','',NULL,2,'2025-05-09 15:40:21',NULL,NULL),('Antonio','Roque Valerian','Antonio Roque Valerian','77135854','antoRV@gmail.com','Calle San Francisco Nro 90','','','','','Bolivia','',NULL,3,'2025-05-12 20:26:37','2025-05-19 15:45:15',NULL),('Estefani','Garcia Lopez','Estefani Garcia Lopez','71558693','estefLop123@gmail.com','','','','','','','',NULL,4,'2025-05-13 14:38:12',NULL,NULL);
/*!40000 ALTER TABLE `phppos_people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_people_files`
--

DROP TABLE IF EXISTS `phppos_people_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_people_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(10) NOT NULL,
  `person_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_people_files_ibfk_1` (`file_id`),
  CONSTRAINT `phppos_people_files_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `phppos_app_files` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_people_files`
--

LOCK TABLES `phppos_people_files` WRITE;
/*!40000 ALTER TABLE `phppos_people_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_people_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_people_name_prefixes`
--

DROP TABLE IF EXISTS `phppos_people_name_prefixes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_people_name_prefixes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_people_name_prefixes`
--

LOCK TABLES `phppos_people_name_prefixes` WRITE;
/*!40000 ALTER TABLE `phppos_people_name_prefixes` DISABLE KEYS */;
INSERT INTO `phppos_people_name_prefixes` VALUES (1,'common_mr.'),(2,'common_mrs.'),(3,'common_dr.'),(4,'common_miss'),(5,'common_ms'),(6,'common_hon.'),(7,'common_prof.'),(8,'common_rev.'),(9,'common_rt_hon.'),(10,'common_sr.'),(11,'common_jr.'),(12,'common_st.');
/*!40000 ALTER TABLE `phppos_people_name_prefixes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions`
--

DROP TABLE IF EXISTS `phppos_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions` (
  `module_id` varchar(100) NOT NULL,
  `person_id` int(10) NOT NULL,
  PRIMARY KEY (`module_id`,`person_id`),
  KEY `person_id` (`person_id`),
  CONSTRAINT `phppos_permissions_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_permissions_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions`
--

LOCK TABLES `phppos_permissions` WRITE;
/*!40000 ALTER TABLE `phppos_permissions` DISABLE KEYS */;
INSERT INTO `phppos_permissions` VALUES ('appointments',1),('config',1),('customers',1),('deliveries',1),('employees',1),('expenses',1),('giftcards',1),('invoices',1),('item_kits',1),('items',1),('locations',1),('messages',1),('price_rules',1),('receivings',1),('reports',1),('sales',1),('suppliers',1),('work_orders',1);
/*!40000 ALTER TABLE `phppos_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions_actions`
--

DROP TABLE IF EXISTS `phppos_permissions_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions_actions` (
  `module_id` varchar(100) NOT NULL,
  `person_id` int(11) NOT NULL,
  `action_id` varchar(100) NOT NULL,
  PRIMARY KEY (`module_id`,`person_id`,`action_id`),
  KEY `phppos_permissions_actions_ibfk_2` (`person_id`),
  KEY `phppos_permissions_actions_ibfk_3` (`action_id`),
  CONSTRAINT `phppos_permissions_actions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`),
  CONSTRAINT `phppos_permissions_actions_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_permissions_actions_ibfk_3` FOREIGN KEY (`action_id`) REFERENCES `phppos_modules_actions` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions_actions`
--

LOCK TABLES `phppos_permissions_actions` WRITE;
/*!40000 ALTER TABLE `phppos_permissions_actions` DISABLE KEYS */;
INSERT INTO `phppos_permissions_actions` VALUES ('appointments',1,'add'),('appointments',1,'delete'),('appointments',1,'edit'),('appointments',1,'search'),('customers',1,'add_update'),('customers',1,'delete'),('customers',1,'edit_customer_points'),('customers',1,'edit_store_account_balance'),('customers',1,'edit_tier'),('customers',1,'excel_export'),('customers',1,'export_to_sidekick'),('customers',1,'search'),('deliveries',1,'add_update'),('deliveries',1,'delete'),('deliveries',1,'edit'),('deliveries',1,'manage_categories'),('deliveries',1,'manage_statuses'),('deliveries',1,'search'),('employees',1,'add_update'),('employees',1,'assign_all_locations'),('employees',1,'delete'),('employees',1,'edit_profile'),('employees',1,'excel_export'),('employees',1,'search'),('expenses',1,'add_update'),('expenses',1,'delete'),('expenses',1,'manage_categories'),('expenses',1,'search'),('giftcards',1,'add_update'),('giftcards',1,'delete'),('giftcards',1,'edit_giftcard_value'),('giftcards',1,'excel_export'),('giftcards',1,'search'),('invoices',1,'add'),('invoices',1,'delete'),('invoices',1,'edit'),('invoices',1,'search'),('item_kits',1,'add_update'),('item_kits',1,'delete'),('item_kits',1,'edit_prices'),('item_kits',1,'excel_export'),('item_kits',1,'search'),('item_kits',1,'see_all_item_kits'),('item_kits',1,'see_cost_price'),('items',1,'add_update'),('items',1,'can_edit_inventory_comment'),('items',1,'count_inventory'),('items',1,'delete'),('items',1,'edit_prices'),('items',1,'edit_quantity'),('items',1,'excel_export'),('items',1,'manage_categories'),('items',1,'manage_manufacturers'),('items',1,'manage_tags'),('items',1,'search'),('items',1,'see_all_items'),('items',1,'see_cost_price'),('items',1,'see_count_when_count_inventory'),('items',1,'see_item_quantity'),('items',1,'view_inventory_at_all_locations'),('items',1,'view_inventory_print_list'),('locations',1,'add_update'),('locations',1,'delete'),('locations',1,'search'),('messages',1,'send_message'),('price_rules',1,'add_update'),('price_rules',1,'delete'),('price_rules',1,'search'),('receivings',1,'allow_item_search_suggestions_for_receivings'),('receivings',1,'allow_supplier_search_suggestions_for_suppliers'),('receivings',1,'complete_transfer'),('receivings',1,'delete_receiving'),('receivings',1,'delete_suspended_receiving'),('receivings',1,'delete_taxes'),('receivings',1,'edit_receiving'),('receivings',1,'edit_taxes'),('receivings',1,'give_discount'),('receivings',1,'receive_store_account_payment'),('receivings',1,'send_transfer'),('receivings',1,'view_suspended_receipt'),('reports',1,'can_change_report_date'),('reports',1,'delete_register_log'),('reports',1,'edit_register_log'),('reports',1,'show_cost_price'),('reports',1,'show_profit'),('reports',1,'view_all_employee_commissions'),('reports',1,'view_appointments'),('reports',1,'view_categories'),('reports',1,'view_closeout'),('reports',1,'view_commissions'),('reports',1,'view_customers'),('reports',1,'view_dashboard_stats'),('reports',1,'view_deleted_sales'),('reports',1,'view_deliveries'),('reports',1,'view_discounts'),('reports',1,'view_employees'),('reports',1,'view_expenses'),('reports',1,'view_giftcards'),('reports',1,'view_inventory_at_all_locations'),('reports',1,'view_inventory_reports'),('reports',1,'view_invoices_reports'),('reports',1,'view_item_kits'),('reports',1,'view_items'),('reports',1,'view_manufacturers'),('reports',1,'view_payments'),('reports',1,'view_price_rules'),('reports',1,'view_profit_and_loss'),('reports',1,'view_receivings'),('reports',1,'view_register_log'),('reports',1,'view_registers'),('reports',1,'view_sales'),('reports',1,'view_sales_generator'),('reports',1,'view_store_account'),('reports',1,'view_store_account_suppliers'),('reports',1,'view_suppliers'),('reports',1,'view_suspended_sales'),('reports',1,'view_tags'),('reports',1,'view_taxes'),('reports',1,'view_tiers'),('reports',1,'view_timeclock'),('sales',1,'add_remove_amounts_from_cash_drawer'),('sales',1,'allow_customer_search_suggestions_for_sales'),('sales',1,'allow_item_search_suggestions_for_sales'),('sales',1,'can_delete_item_from_sale'),('sales',1,'can_lookup_last_receipt'),('sales',1,'can_lookup_receipt'),('sales',1,'change_sale_date'),('sales',1,'complete_sale'),('sales',1,'delete_sale'),('sales',1,'delete_suspended_sale'),('sales',1,'delete_taxes'),('sales',1,'edit_sale'),('sales',1,'edit_sale_cost_price'),('sales',1,'edit_sale_price'),('sales',1,'edit_suspended_sale'),('sales',1,'edit_suspended_sale_data'),('sales',1,'edit_taxes'),('sales',1,'give_discount'),('sales',1,'process_returns'),('sales',1,'receive_store_account_payment'),('sales',1,'search'),('sales',1,'suspend_sale'),('sales',1,'view_edit_transaction_history'),('sales',1,'view_suspended_receipt'),('suppliers',1,'add_update'),('suppliers',1,'delete'),('suppliers',1,'edit_store_account_balance'),('suppliers',1,'excel_export'),('suppliers',1,'search'),('work_orders',1,'delete'),('work_orders',1,'delete_log_activity'),('work_orders',1,'edit'),('work_orders',1,'manage_statuses'),('work_orders',1,'search');
/*!40000 ALTER TABLE `phppos_permissions_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions_actions_locations`
--

DROP TABLE IF EXISTS `phppos_permissions_actions_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions_actions_locations` (
  `module_id` varchar(100) NOT NULL,
  `person_id` int(11) NOT NULL,
  `action_id` varchar(100) NOT NULL,
  `location_id` int(10) NOT NULL,
  PRIMARY KEY (`module_id`,`person_id`,`action_id`,`location_id`),
  KEY `phppos_permissions_actions_locations_ibfk_2` (`person_id`),
  KEY `phppos_permissions_actions_locations_ibfk_3` (`action_id`),
  KEY `phppos_permissions_actions_locations_ibfk_4` (`location_id`),
  CONSTRAINT `phppos_permissions_actions_locations_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`),
  CONSTRAINT `phppos_permissions_actions_locations_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_permissions_actions_locations_ibfk_3` FOREIGN KEY (`action_id`) REFERENCES `phppos_modules_actions` (`action_id`),
  CONSTRAINT `phppos_permissions_actions_locations_ibfk_4` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions_actions_locations`
--

LOCK TABLES `phppos_permissions_actions_locations` WRITE;
/*!40000 ALTER TABLE `phppos_permissions_actions_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_permissions_actions_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions_locations`
--

DROP TABLE IF EXISTS `phppos_permissions_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions_locations` (
  `module_id` varchar(100) NOT NULL,
  `person_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  PRIMARY KEY (`module_id`,`person_id`,`location_id`),
  KEY `phppos_permissions_locations_ibfk_1` (`person_id`),
  KEY `phppos_permissions_locations_ibfk_3` (`location_id`),
  CONSTRAINT `phppos_permissions_locations_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_permissions_locations_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`),
  CONSTRAINT `phppos_permissions_locations_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions_locations`
--

LOCK TABLES `phppos_permissions_locations` WRITE;
/*!40000 ALTER TABLE `phppos_permissions_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_permissions_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions_template`
--

DROP TABLE IF EXISTS `phppos_permissions_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions_template` (
  `template_id` int(11) NOT NULL,
  `module_id` varchar(100) NOT NULL,
  PRIMARY KEY (`template_id`,`module_id`),
  KEY `phppos_permissions_template_ibfk_1` (`module_id`),
  CONSTRAINT `phppos_permissions_template_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`),
  CONSTRAINT `phppos_permissions_template_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `phppos_permissions_templates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions_template`
--

LOCK TABLES `phppos_permissions_template` WRITE;
/*!40000 ALTER TABLE `phppos_permissions_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_permissions_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions_template_actions`
--

DROP TABLE IF EXISTS `phppos_permissions_template_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions_template_actions` (
  `template_id` int(11) NOT NULL,
  `module_id` varchar(100) NOT NULL,
  `action_id` varchar(100) NOT NULL,
  PRIMARY KEY (`template_id`,`module_id`,`action_id`),
  KEY `phppos_permissions_template_actions_ibfk_2` (`action_id`),
  KEY `phppos_permissions_template_actions_ibfk_3` (`template_id`),
  KEY `phppos_permissions_template_actions_ibfk_1` (`module_id`),
  CONSTRAINT `phppos_permissions_template_actions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`),
  CONSTRAINT `phppos_permissions_template_actions_ibfk_2` FOREIGN KEY (`action_id`) REFERENCES `phppos_modules_actions` (`action_id`),
  CONSTRAINT `phppos_permissions_template_actions_ibfk_3` FOREIGN KEY (`template_id`) REFERENCES `phppos_permissions_templates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions_template_actions`
--

LOCK TABLES `phppos_permissions_template_actions` WRITE;
/*!40000 ALTER TABLE `phppos_permissions_template_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_permissions_template_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions_template_actions_locations`
--

DROP TABLE IF EXISTS `phppos_permissions_template_actions_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions_template_actions_locations` (
  `template_id` int(11) NOT NULL,
  `module_id` varchar(100) NOT NULL,
  `action_id` varchar(100) NOT NULL,
  `location_id` int(10) NOT NULL,
  PRIMARY KEY (`template_id`,`module_id`,`action_id`,`location_id`),
  KEY `phppos_permissions_template_actions_locations_ibfk_2` (`action_id`),
  KEY `phppos_permissions_template_actions_locations_ibfk_3` (`location_id`),
  KEY `phppos_permissions_template_actions_locations_ibfk_4` (`template_id`),
  KEY `phppos_permissions_template_actions_locations_ibfk_1` (`module_id`),
  CONSTRAINT `phppos_permissions_template_actions_locations_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`),
  CONSTRAINT `phppos_permissions_template_actions_locations_ibfk_2` FOREIGN KEY (`action_id`) REFERENCES `phppos_modules_actions` (`action_id`),
  CONSTRAINT `phppos_permissions_template_actions_locations_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_permissions_template_actions_locations_ibfk_4` FOREIGN KEY (`template_id`) REFERENCES `phppos_permissions_templates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions_template_actions_locations`
--

LOCK TABLES `phppos_permissions_template_actions_locations` WRITE;
/*!40000 ALTER TABLE `phppos_permissions_template_actions_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_permissions_template_actions_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions_template_locations`
--

DROP TABLE IF EXISTS `phppos_permissions_template_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions_template_locations` (
  `template_id` int(11) NOT NULL,
  `module_id` varchar(100) NOT NULL,
  `location_id` int(10) NOT NULL,
  PRIMARY KEY (`template_id`,`module_id`,`location_id`),
  KEY `phppos_permissions_template_locations_ibfk_2` (`location_id`),
  KEY `phppos_permissions_template_locations_ibfk_3` (`template_id`),
  KEY `phppos_permissions_template_locations_ibfk_1` (`module_id`),
  CONSTRAINT `phppos_permissions_template_locations_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `phppos_modules` (`module_id`),
  CONSTRAINT `phppos_permissions_template_locations_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_permissions_template_locations_ibfk_3` FOREIGN KEY (`template_id`) REFERENCES `phppos_permissions_templates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions_template_locations`
--

LOCK TABLES `phppos_permissions_template_locations` WRITE;
/*!40000 ALTER TABLE `phppos_permissions_template_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_permissions_template_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_permissions_templates`
--

DROP TABLE IF EXISTS `phppos_permissions_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_permissions_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deleted` int(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`),
  KEY `name` (`name`),
  KEY `name_deleted` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_permissions_templates`
--

LOCK TABLES `phppos_permissions_templates` WRITE;
/*!40000 ALTER TABLE `phppos_permissions_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_permissions_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules`
--

DROP TABLE IF EXISTS `phppos_price_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT current_timestamp(),
  `active` int(1) NOT NULL DEFAULT 1,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL,
  `items_to_buy` decimal(23,10) DEFAULT NULL,
  `items_to_get` decimal(23,10) DEFAULT NULL,
  `percent_off` decimal(23,10) DEFAULT NULL,
  `fixed_off` decimal(23,10) DEFAULT NULL,
  `spend_amount` decimal(23,10) DEFAULT NULL,
  `num_times_to_apply` int(10) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `show_on_receipt` int(1) NOT NULL DEFAULT 0,
  `coupon_spend_amount` decimal(23,10) DEFAULT NULL,
  `mix_and_match` int(1) NOT NULL DEFAULT 0,
  `disable_loyalty_for_rule` int(1) NOT NULL DEFAULT 0,
  `days_of_week` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules`
--

LOCK TABLES `phppos_price_rules` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules_categories`
--

DROP TABLE IF EXISTS `phppos_price_rules_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rule_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_price_rules_categories_ibfk_1` (`rule_id`),
  KEY `phppos_price_rules_categories_ibfk_2` (`category_id`),
  CONSTRAINT `phppos_price_rules_categories_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_price_rules_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `phppos_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules_categories`
--

LOCK TABLES `phppos_price_rules_categories` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules_item_kits`
--

DROP TABLE IF EXISTS `phppos_price_rules_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules_item_kits` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rule_id` int(10) NOT NULL,
  `item_kit_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_price_rules_item_kits_ibfk_1` (`rule_id`),
  KEY `phppos_price_rules_item_kits_ibfk_2` (`item_kit_id`),
  CONSTRAINT `phppos_price_rules_item_kits_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_price_rules_item_kits_ibfk_2` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules_item_kits`
--

LOCK TABLES `phppos_price_rules_item_kits` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules_items`
--

DROP TABLE IF EXISTS `phppos_price_rules_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rule_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_price_rules_items_ibfk_1` (`rule_id`),
  KEY `phppos_price_rules_items_ibfk_2` (`item_id`),
  CONSTRAINT `phppos_price_rules_items_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_price_rules_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules_items`
--

LOCK TABLES `phppos_price_rules_items` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules_locations`
--

DROP TABLE IF EXISTS `phppos_price_rules_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules_locations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rule_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_price_rules_locations_ibfk_1` (`rule_id`),
  KEY `phppos_price_rules_locations_ibfk_2` (`location_id`),
  CONSTRAINT `phppos_price_rules_locations_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_price_rules_locations_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules_locations`
--

LOCK TABLES `phppos_price_rules_locations` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules_manufacturers`
--

DROP TABLE IF EXISTS `phppos_price_rules_manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules_manufacturers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rule_id` int(10) NOT NULL,
  `manufacturer_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_price_rules_manufacturers_ibfk_1` (`rule_id`),
  KEY `phppos_price_rules_manufacturers_ibfk_2` (`manufacturer_id`),
  CONSTRAINT `phppos_price_rules_manufacturers_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_price_rules_manufacturers_ibfk_2` FOREIGN KEY (`manufacturer_id`) REFERENCES `phppos_manufacturers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules_manufacturers`
--

LOCK TABLES `phppos_price_rules_manufacturers` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules_manufacturers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules_manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules_price_breaks`
--

DROP TABLE IF EXISTS `phppos_price_rules_price_breaks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules_price_breaks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rule_id` int(10) NOT NULL,
  `item_qty_to_buy` decimal(23,10) DEFAULT NULL,
  `discount_per_unit_fixed` decimal(23,10) DEFAULT NULL,
  `discount_per_unit_percent` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_price_rules_custom_ibfk_1` (`rule_id`),
  CONSTRAINT `phppos_price_rules_price_breaks_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules_price_breaks`
--

LOCK TABLES `phppos_price_rules_price_breaks` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules_price_breaks` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules_price_breaks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules_tags`
--

DROP TABLE IF EXISTS `phppos_price_rules_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rule_id` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_price_rules_tags_ibfk_1` (`rule_id`),
  KEY `phppos_price_rules_tags_ibfk_2` (`tag_id`),
  CONSTRAINT `phppos_price_rules_tags_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_price_rules_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `phppos_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules_tags`
--

LOCK TABLES `phppos_price_rules_tags` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_rules_tiers_exclude`
--

DROP TABLE IF EXISTS `phppos_price_rules_tiers_exclude`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_rules_tiers_exclude` (
  `price_rule_id` int(10) NOT NULL,
  `tier_id` int(10) NOT NULL,
  PRIMARY KEY (`price_rule_id`,`tier_id`),
  KEY `phppos_price_rules_tiers_ibfk_2` (`tier_id`),
  CONSTRAINT `phppos_price_rules_tiers_ibfk_1` FOREIGN KEY (`price_rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_price_rules_tiers_ibfk_2` FOREIGN KEY (`tier_id`) REFERENCES `phppos_price_tiers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_rules_tiers_exclude`
--

LOCK TABLES `phppos_price_rules_tiers_exclude` WRITE;
/*!40000 ALTER TABLE `phppos_price_rules_tiers_exclude` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_rules_tiers_exclude` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_price_tiers`
--

DROP TABLE IF EXISTS `phppos_price_tiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_price_tiers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order` int(10) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `default_percent_off` decimal(15,3) DEFAULT NULL,
  `default_cost_plus_percent` decimal(15,3) DEFAULT NULL,
  `default_cost_plus_fixed_amount` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_price_tiers`
--

LOCK TABLES `phppos_price_tiers` WRITE;
/*!40000 ALTER TABLE `phppos_price_tiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_price_tiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_processing_return_logs`
--

DROP TABLE IF EXISTS `phppos_processing_return_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_processing_return_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_time` timestamp NULL DEFAULT current_timestamp(),
  `employee_id` int(10) NOT NULL,
  `sale_id` int(10) DEFAULT NULL,
  `orig_voided_processor_transaction_id` varchar(255) NOT NULL,
  `voided_processor_transaction_id` varchar(255) NOT NULL,
  `amount` decimal(23,10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_processing_return_logs_ibfk_1` (`employee_id`),
  KEY `phppos_processing_return_logs_ibfk_2` (`sale_id`),
  CONSTRAINT `phppos_processing_return_logs_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_processing_return_logs_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_processing_return_logs`
--

LOCK TABLES `phppos_processing_return_logs` WRITE;
/*!40000 ALTER TABLE `phppos_processing_return_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_processing_return_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_puntos_venta_siat`
--

DROP TABLE IF EXISTS `phppos_puntos_venta_siat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_puntos_venta_siat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `nro_punto_venta` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo_punto_venta` varchar(50) DEFAULT NULL,
  `tipo_emision` varchar(50) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 1,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`),
  CONSTRAINT `phppos_puntos_venta_siat_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `phppos_sucursales_siat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_puntos_venta_siat`
--

LOCK TABLES `phppos_puntos_venta_siat` WRITE;
/*!40000 ALTER TABLE `phppos_puntos_venta_siat` DISABLE KEYS */;
INSERT INTO `phppos_puntos_venta_siat` VALUES (1,1,0,'Matriz','1','1',1,'2025-05-21 11:23:46');
/*!40000 ALTER TABLE `phppos_puntos_venta_siat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_receivings`
--

DROP TABLE IF EXISTS `phppos_receivings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_receivings` (
  `receiving_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `supplier_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT 0,
  `comment` text NOT NULL,
  `receiving_id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_type` text DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `deleted_by` int(10) DEFAULT NULL,
  `suspended` int(1) NOT NULL DEFAULT 0,
  `location_id` int(11) NOT NULL,
  `transfer_to_location_id` int(11) DEFAULT NULL,
  `deleted_taxes` text DEFAULT NULL,
  `is_po` int(1) NOT NULL DEFAULT 0,
  `store_account_payment` int(1) NOT NULL DEFAULT 0,
  `total_quantity_purchased` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `total_quantity_received` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `subtotal` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `tax` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `total` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `profit` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `exchange_rate` decimal(23,10) NOT NULL DEFAULT 1.0000000000,
  `exchange_name` varchar(255) NOT NULL DEFAULT '',
  `exchange_currency_symbol` varchar(255) NOT NULL DEFAULT '',
  `exchange_currency_symbol_location` varchar(255) NOT NULL DEFAULT '',
  `exchange_number_of_decimals` varchar(255) NOT NULL DEFAULT '',
  `exchange_thousands_separator` varchar(255) NOT NULL DEFAULT '',
  `exchange_decimal_point` varchar(255) NOT NULL DEFAULT '',
  `custom_field_1_value` varchar(255) DEFAULT NULL,
  `custom_field_2_value` varchar(255) DEFAULT NULL,
  `custom_field_3_value` varchar(255) DEFAULT NULL,
  `custom_field_4_value` varchar(255) DEFAULT NULL,
  `custom_field_5_value` varchar(255) DEFAULT NULL,
  `custom_field_6_value` varchar(255) DEFAULT NULL,
  `custom_field_7_value` varchar(255) DEFAULT NULL,
  `custom_field_8_value` varchar(255) DEFAULT NULL,
  `custom_field_9_value` varchar(255) DEFAULT NULL,
  `custom_field_10_value` varchar(255) DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `override_taxes` text DEFAULT NULL,
  `shipping_cost` decimal(23,10) DEFAULT NULL,
  `signature_image_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`receiving_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `employee_id` (`employee_id`),
  KEY `deleted` (`deleted`),
  KEY `location_id` (`location_id`),
  KEY `transfer_to_location_id` (`transfer_to_location_id`),
  KEY `recv_search` (`location_id`,`deleted`,`receiving_time`,`suspended`,`store_account_payment`,`total_quantity_purchased`),
  KEY `custom_field_1_value` (`custom_field_1_value`),
  KEY `custom_field_2_value` (`custom_field_2_value`),
  KEY `custom_field_3_value` (`custom_field_3_value`),
  KEY `custom_field_4_value` (`custom_field_4_value`),
  KEY `custom_field_5_value` (`custom_field_5_value`),
  KEY `custom_field_6_value` (`custom_field_6_value`),
  KEY `custom_field_7_value` (`custom_field_7_value`),
  KEY `custom_field_8_value` (`custom_field_8_value`),
  KEY `custom_field_9_value` (`custom_field_9_value`),
  KEY `custom_field_10_value` (`custom_field_10_value`),
  KEY `signature_image_id` (`signature_image_id`),
  CONSTRAINT `phppos_receivings_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_receivings_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`),
  CONSTRAINT `phppos_receivings_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_receivings_ibfk_4` FOREIGN KEY (`transfer_to_location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_receivings_ibfk_5` FOREIGN KEY (`signature_image_id`) REFERENCES `phppos_app_files` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_receivings`
--

LOCK TABLES `phppos_receivings` WRITE;
/*!40000 ALTER TABLE `phppos_receivings` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_receivings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_receivings_items`
--

DROP TABLE IF EXISTS `phppos_receivings_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_receivings_items` (
  `receiving_id` int(10) NOT NULL DEFAULT 0,
  `item_id` int(10) NOT NULL DEFAULT 0,
  `item_variation_id` int(10) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `serialnumber` varchar(255) DEFAULT NULL,
  `line` int(11) NOT NULL DEFAULT 0,
  `quantity_purchased` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `quantity_received` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `item_cost_price` decimal(23,10) NOT NULL,
  `item_unit_price` decimal(23,10) NOT NULL,
  `discount_percent` decimal(15,3) NOT NULL DEFAULT 0.000,
  `expire_date` date DEFAULT NULL,
  `subtotal` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `tax` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `total` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `profit` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `override_taxes` text DEFAULT NULL,
  `unit_quantity` decimal(23,10) DEFAULT NULL,
  `items_quantity_units_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `receipt_line_sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`receiving_id`,`item_id`,`line`),
  KEY `item_id` (`item_id`),
  KEY `phppos_receivings_items_ibfk_3` (`item_variation_id`),
  KEY `phppos_receivings_items_ibfk_4` (`items_quantity_units_id`),
  KEY `serialnumber` (`serialnumber`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `phppos_receivings_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_receivings_items_ibfk_2` FOREIGN KEY (`receiving_id`) REFERENCES `phppos_receivings` (`receiving_id`),
  CONSTRAINT `phppos_receivings_items_ibfk_3` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_receivings_items_ibfk_4` FOREIGN KEY (`items_quantity_units_id`) REFERENCES `phppos_items_quantity_units` (`id`),
  CONSTRAINT `phppos_receivings_items_ibfk_5` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_receivings_items`
--

LOCK TABLES `phppos_receivings_items` WRITE;
/*!40000 ALTER TABLE `phppos_receivings_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_receivings_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_receivings_items_taxes`
--

DROP TABLE IF EXISTS `phppos_receivings_items_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_receivings_items_taxes` (
  `receiving_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`receiving_id`,`item_id`,`line`,`name`,`percent`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `phppos_receivings_items_taxes_ibfk_1` FOREIGN KEY (`receiving_id`) REFERENCES `phppos_receivings` (`receiving_id`),
  CONSTRAINT `phppos_receivings_items_taxes_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_receivings_items_taxes`
--

LOCK TABLES `phppos_receivings_items_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_receivings_items_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_receivings_items_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_receivings_payments`
--

DROP TABLE IF EXISTS `phppos_receivings_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_receivings_payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `receiving_id` int(10) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_amount` decimal(23,10) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`payment_id`),
  KEY `receiving_id` (`receiving_id`),
  KEY `payment_date` (`payment_date`),
  CONSTRAINT `phppos_receivings_payments_ibfk_1` FOREIGN KEY (`receiving_id`) REFERENCES `phppos_receivings` (`receiving_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_receivings_payments`
--

LOCK TABLES `phppos_receivings_payments` WRITE;
/*!40000 ALTER TABLE `phppos_receivings_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_receivings_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_register_currency_denominations`
--

DROP TABLE IF EXISTS `phppos_register_currency_denominations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_register_currency_denominations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` decimal(23,10) NOT NULL,
  `deleted` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_register_currency_denominations`
--

LOCK TABLES `phppos_register_currency_denominations` WRITE;
/*!40000 ALTER TABLE `phppos_register_currency_denominations` DISABLE KEYS */;
INSERT INTO `phppos_register_currency_denominations` VALUES (1,'100\'s',100.0000000000,0),(2,'50\'s',50.0000000000,0),(3,'20\'s',20.0000000000,0),(4,'10\'s',10.0000000000,0),(5,'5\'s',5.0000000000,0),(6,'2\'s',2.0000000000,0),(7,'1\'s',1.0000000000,0),(8,'Half Dollars',0.5000000000,0),(9,'Quarters',0.2500000000,0),(10,'Dimes',0.1000000000,0),(11,'Nickels',0.0500000000,0),(12,'Pennies',0.0100000000,0);
/*!40000 ALTER TABLE `phppos_register_currency_denominations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_register_log`
--

DROP TABLE IF EXISTS `phppos_register_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_register_log` (
  `register_log_id` int(10) NOT NULL AUTO_INCREMENT,
  `employee_id_open` int(10) NOT NULL,
  `employee_id_close` int(11) DEFAULT NULL,
  `register_id` int(11) DEFAULT NULL,
  `shift_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `shift_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `notes` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`register_log_id`),
  KEY `phppos_register_log_ibfk_1` (`employee_id_open`),
  KEY `phppos_register_log_ibfk_2` (`register_id`),
  KEY `phppos_register_log_ibfk_3` (`employee_id_close`),
  CONSTRAINT `phppos_register_log_ibfk_1` FOREIGN KEY (`employee_id_open`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_register_log_ibfk_2` FOREIGN KEY (`register_id`) REFERENCES `phppos_registers` (`register_id`),
  CONSTRAINT `phppos_register_log_ibfk_3` FOREIGN KEY (`employee_id_close`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_register_log`
--

LOCK TABLES `phppos_register_log` WRITE;
/*!40000 ALTER TABLE `phppos_register_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_register_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_register_log_audit`
--

DROP TABLE IF EXISTS `phppos_register_log_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_register_log_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_log_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `note` text NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `register_log_audit_ibfk_1` (`register_log_id`),
  KEY `register_log_audit_ibfk_2` (`employee_id`),
  CONSTRAINT `register_log_audit_ibfk_1` FOREIGN KEY (`register_log_id`) REFERENCES `phppos_register_log` (`register_log_id`),
  CONSTRAINT `register_log_audit_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_register_log_audit`
--

LOCK TABLES `phppos_register_log_audit` WRITE;
/*!40000 ALTER TABLE `phppos_register_log_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_register_log_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_register_log_denoms`
--

DROP TABLE IF EXISTS `phppos_register_log_denoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_register_log_denoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_log_id` int(11) NOT NULL,
  `register_currency_denominations_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_register_log_denoms_ibfk_1` (`register_log_id`),
  KEY `phppos_register_log_denoms_ibfk_2` (`register_currency_denominations_id`),
  CONSTRAINT `phppos_register_log_denoms_ibfk_1` FOREIGN KEY (`register_log_id`) REFERENCES `phppos_register_log` (`register_log_id`),
  CONSTRAINT `phppos_register_log_denoms_ibfk_2` FOREIGN KEY (`register_currency_denominations_id`) REFERENCES `phppos_register_currency_denominations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_register_log_denoms`
--

LOCK TABLES `phppos_register_log_denoms` WRITE;
/*!40000 ALTER TABLE `phppos_register_log_denoms` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_register_log_denoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_register_log_payments`
--

DROP TABLE IF EXISTS `phppos_register_log_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_register_log_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_log_id` int(10) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `open_amount` decimal(23,10) NOT NULL,
  `close_amount` decimal(23,10) NOT NULL,
  `payment_sales_amount` decimal(23,10) NOT NULL,
  `total_payment_additions` decimal(23,10) NOT NULL,
  `total_payment_subtractions` decimal(23,10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_register_log_payments_ibfk_1` (`register_log_id`),
  CONSTRAINT `phppos_register_log_payments_ibfk_1` FOREIGN KEY (`register_log_id`) REFERENCES `phppos_register_log` (`register_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_register_log_payments`
--

LOCK TABLES `phppos_register_log_payments` WRITE;
/*!40000 ALTER TABLE `phppos_register_log_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_register_log_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_registers`
--

DROP TABLE IF EXISTS `phppos_registers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_registers` (
  `register_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iptran_device_id` varchar(255) DEFAULT NULL,
  `emv_terminal_id` varchar(255) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `card_connect_hsn` varchar(255) DEFAULT NULL,
  `emv_pinpad_ip` varchar(255) DEFAULT NULL,
  `emv_pinpad_port` varchar(255) DEFAULT NULL,
  `enable_tips` int(1) DEFAULT 0,
  PRIMARY KEY (`register_id`),
  KEY `deleted` (`deleted`),
  KEY `phppos_registers_ibfk_1` (`location_id`),
  CONSTRAINT `phppos_registers_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_registers`
--

LOCK TABLES `phppos_registers` WRITE;
/*!40000 ALTER TABLE `phppos_registers` DISABLE KEYS */;
INSERT INTO `phppos_registers` VALUES (1,1,'Default',NULL,NULL,0,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `phppos_registers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_registers_cart`
--

DROP TABLE IF EXISTS `phppos_registers_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_registers_cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `register_id` int(11) NOT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `register_id` (`register_id`),
  CONSTRAINT `phppos_registers_cart_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `phppos_registers` (`register_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_registers_cart`
--

LOCK TABLES `phppos_registers_cart` WRITE;
/*!40000 ALTER TABLE `phppos_registers_cart` DISABLE KEYS */;
INSERT INTO `phppos_registers_cart` VALUES (1,1,_binary 'a:14:{s:4:\"cart\";a:0:{}s:8:\"subtotal\";s:4:\"0.00\";s:3:\"tax\";s:4:\"0.00\";s:10:\"amount_due\";s:4:\"0.00\";s:13:\"exchange_rate\";i:1;s:13:\"exchange_name\";N;s:15:\"exchange_symbol\";s:2:\"Bs\";s:24:\"exchange_symbol_location\";s:6:\"before\";s:27:\"exchange_number_of_decimals\";N;s:28:\"exchange_thousands_separator\";s:1:\",\";s:22:\"exchange_decimal_point\";s:1:\".\";s:8:\"customer\";N;s:8:\"payments\";a:0:{}s:5:\"total\";s:4:\"0.00\";}');
/*!40000 ALTER TABLE `phppos_registers_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sale_types`
--

DROP TABLE IF EXISTS `phppos_sale_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sale_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sort` int(10) NOT NULL,
  `system_sale_type` int(1) NOT NULL DEFAULT 0,
  `remove_quantity` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sale_types`
--

LOCK TABLES `phppos_sale_types` WRITE;
/*!40000 ALTER TABLE `phppos_sale_types` DISABLE KEYS */;
INSERT INTO `phppos_sale_types` VALUES (0,'common_sale',0,1,0),(1,'common_layaway',0,1,1),(2,'common_estimate',0,1,0),(3,'E-Commerce',1,0,1);
/*!40000 ALTER TABLE `phppos_sale_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales`
--

DROP TABLE IF EXISTS `phppos_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales` (
  `sale_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT 0,
  `sold_by_employee_id` int(10) DEFAULT NULL,
  `comment` text NOT NULL,
  `discount_reason` text NOT NULL,
  `show_comment_on_receipt` int(1) NOT NULL DEFAULT 0,
  `sale_id` int(10) NOT NULL AUTO_INCREMENT,
  `rule_id` int(10) DEFAULT NULL,
  `rule_discount` decimal(23,10) DEFAULT NULL,
  `payment_type` text DEFAULT NULL,
  `cc_ref_no` varchar(255) NOT NULL,
  `auth_code` varchar(255) DEFAULT '',
  `deleted_by` int(10) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `suspended` int(10) NOT NULL DEFAULT 0,
  `is_ecommerce` int(1) NOT NULL DEFAULT 0,
  `ecommerce_order_id` bigint(20) DEFAULT NULL,
  `ecommerce_status` varchar(255) NOT NULL DEFAULT '',
  `store_account_payment` int(1) NOT NULL DEFAULT 0,
  `was_layaway` int(1) NOT NULL DEFAULT 0,
  `was_estimate` int(1) NOT NULL DEFAULT 0,
  `location_id` int(11) NOT NULL,
  `register_id` int(11) DEFAULT NULL,
  `tier_id` int(10) DEFAULT NULL,
  `points_used` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `points_gained` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `did_redeem_discount` int(1) NOT NULL DEFAULT 0,
  `signature_image_id` int(10) DEFAULT NULL,
  `deleted_taxes` text DEFAULT NULL,
  `total_quantity_purchased` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `subtotal` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `tax` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `total` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `profit` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `exchange_rate` decimal(23,10) NOT NULL DEFAULT 1.0000000000,
  `exchange_name` varchar(255) NOT NULL DEFAULT '',
  `exchange_currency_symbol` varchar(255) NOT NULL DEFAULT '',
  `exchange_currency_symbol_location` varchar(255) NOT NULL DEFAULT '',
  `exchange_number_of_decimals` varchar(255) NOT NULL DEFAULT '',
  `exchange_thousands_separator` varchar(255) NOT NULL DEFAULT '',
  `exchange_decimal_point` varchar(255) NOT NULL DEFAULT '',
  `is_purchase_points` int(1) NOT NULL DEFAULT 0,
  `custom_field_1_value` varchar(255) DEFAULT NULL,
  `custom_field_2_value` varchar(255) DEFAULT NULL,
  `custom_field_3_value` varchar(255) DEFAULT NULL,
  `custom_field_4_value` varchar(255) DEFAULT NULL,
  `custom_field_5_value` varchar(255) DEFAULT NULL,
  `custom_field_6_value` varchar(255) DEFAULT NULL,
  `custom_field_7_value` varchar(255) DEFAULT NULL,
  `custom_field_8_value` varchar(255) DEFAULT NULL,
  `custom_field_9_value` varchar(255) DEFAULT NULL,
  `custom_field_10_value` varchar(255) DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `override_taxes` text DEFAULT NULL,
  `return_sale_id` int(10) DEFAULT NULL,
  `ref_sale_id` int(10) DEFAULT NULL,
  `ref_sale_desc` text DEFAULT NULL,
  `tip` decimal(23,10) DEFAULT NULL,
  `total_quantity_received` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `non_taxable` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `customer_subscription_id` int(11) DEFAULT NULL,
  `override_tax_class_id` int(11) DEFAULT NULL,
  `return_reason` varchar(255) DEFAULT NULL,
  `is_invoiced` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`sale_id`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`),
  KEY `deleted` (`deleted`),
  KEY `location_id` (`location_id`),
  KEY `phppos_sales_ibfk_4` (`deleted_by`),
  KEY `phppos_sales_ibfk_5` (`tier_id`),
  KEY `phppos_sales_ibfk_7` (`register_id`),
  KEY `phppos_sales_ibfk_6` (`sold_by_employee_id`),
  KEY `phppos_sales_ibfk_8` (`signature_image_id`),
  KEY `was_layaway` (`was_layaway`),
  KEY `was_estimate` (`was_estimate`),
  KEY `phppos_sales_ibfk_9` (`rule_id`),
  KEY `sales_search` (`location_id`,`deleted`,`sale_time`,`suspended`,`store_account_payment`,`total_quantity_purchased`),
  KEY `phppos_sales_ibfk_10` (`suspended`),
  KEY `custom_field_1_value` (`custom_field_1_value`),
  KEY `custom_field_2_value` (`custom_field_2_value`),
  KEY `custom_field_3_value` (`custom_field_3_value`),
  KEY `custom_field_4_value` (`custom_field_4_value`),
  KEY `custom_field_5_value` (`custom_field_5_value`),
  KEY `custom_field_6_value` (`custom_field_6_value`),
  KEY `custom_field_7_value` (`custom_field_7_value`),
  KEY `custom_field_8_value` (`custom_field_8_value`),
  KEY `custom_field_9_value` (`custom_field_9_value`),
  KEY `custom_field_10_value` (`custom_field_10_value`),
  KEY `phppos_sales_ibfk_11` (`return_sale_id`),
  KEY `ecommerce_order_id` (`ecommerce_order_id`),
  KEY `phppos_sales_ibfk_12` (`customer_subscription_id`),
  KEY `ref_sale_id` (`ref_sale_id`),
  CONSTRAINT `phppos_sales_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_sales_ibfk_10` FOREIGN KEY (`suspended`) REFERENCES `phppos_sale_types` (`id`),
  CONSTRAINT `phppos_sales_ibfk_11` FOREIGN KEY (`return_sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_ibfk_12` FOREIGN KEY (`customer_subscription_id`) REFERENCES `phppos_customer_subscriptions` (`id`),
  CONSTRAINT `phppos_sales_ibfk_13` FOREIGN KEY (`ref_sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `phppos_customers` (`person_id`),
  CONSTRAINT `phppos_sales_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_sales_ibfk_4` FOREIGN KEY (`deleted_by`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_sales_ibfk_5` FOREIGN KEY (`tier_id`) REFERENCES `phppos_price_tiers` (`id`),
  CONSTRAINT `phppos_sales_ibfk_6` FOREIGN KEY (`sold_by_employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_sales_ibfk_7` FOREIGN KEY (`register_id`) REFERENCES `phppos_registers` (`register_id`),
  CONSTRAINT `phppos_sales_ibfk_8` FOREIGN KEY (`signature_image_id`) REFERENCES `phppos_app_files` (`file_id`),
  CONSTRAINT `phppos_sales_ibfk_9` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales`
--

LOCK TABLES `phppos_sales` WRITE;
/*!40000 ALTER TABLE `phppos_sales` DISABLE KEYS */;
INSERT INTO `phppos_sales` VALUES ('2025-05-08 21:02:23',NULL,1,1,'','',0,1,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 15:07:37',NULL,1,1,'','',0,2,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 15:24:04',NULL,1,1,'','',0,3,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 15:25:27',NULL,1,1,'','',0,4,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 15:26:09',NULL,1,1,'','',0,5,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 15:30:15',NULL,1,1,'','',0,6,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 15:40:36',2,1,1,'','',0,7,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 15:47:07',2,1,1,'','',0,8,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 15:54:54',2,1,1,'','',0,9,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 16:48:02',2,1,1,'','',0,10,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 17:41:03',2,1,1,'','',0,11,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 17:50:08',2,1,1,'','',0,12,NULL,NULL,'Cash: $20.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,2.0000000000,20.0000000000,0.0000000000,20.0000000000,10.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2.0000000000,20.0000000000,NULL,NULL,NULL,0),('2025-05-09 17:55:34',2,1,1,'','',0,13,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 18:11:36',2,1,1,'','',0,14,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 18:18:00',2,1,1,'','',0,15,NULL,NULL,'Cash: $50.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,5.0000000000,50.0000000000,0.0000000000,50.0000000000,25.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5.0000000000,50.0000000000,NULL,NULL,NULL,0),('2025-05-09 18:22:19',NULL,1,1,'','',0,16,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 18:29:44',NULL,1,1,'','',0,17,NULL,NULL,'Cash: $20.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,2.0000000000,20.0000000000,0.0000000000,20.0000000000,10.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2.0000000000,20.0000000000,NULL,NULL,NULL,0),('2025-05-09 18:32:53',NULL,1,1,'','',0,18,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 18:37:34',NULL,1,1,'','',0,19,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 18:41:19',2,1,1,'','',0,20,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 19:07:20',NULL,1,1,'','',0,21,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 19:17:22',2,1,1,'','',0,22,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 19:38:28',NULL,1,1,'','',0,23,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 20:02:27',2,1,1,'','',0,24,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 20:07:28',NULL,1,1,'','',0,25,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-09 20:17:30',2,1,1,'','',0,26,NULL,NULL,'Cash: $50.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,5.0000000000,50.0000000000,0.0000000000,50.0000000000,25.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5.0000000000,50.0000000000,NULL,NULL,NULL,0),('2025-05-10 12:15:56',NULL,1,1,'','',0,27,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-10 12:48:38',NULL,1,1,'','',0,28,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-10 12:49:32',2,1,1,'','',0,29,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-10 12:57:30',2,1,1,'','',0,30,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-10 13:13:30',NULL,1,1,'','',0,31,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-10 13:26:27',NULL,1,1,'','',0,32,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-10 16:48:30',NULL,1,1,'','',0,33,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 12:45:13',2,1,1,'','',0,34,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 14:07:33',2,1,1,'','',0,35,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 14:08:57',NULL,1,1,'','',0,36,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 14:10:52',NULL,1,1,'','',0,37,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 15:38:48',NULL,1,1,'','',0,38,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 15:40:40',NULL,1,1,'','',0,39,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 15:42:50',NULL,1,1,'','',0,40,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 16:13:34',2,1,1,'','',0,41,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 16:26:13',NULL,1,1,'','',0,42,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 16:27:21',2,1,1,'','',0,43,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 16:29:39',2,1,1,'','',0,44,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 16:34:34',2,1,1,'','',0,45,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 16:41:08',2,1,1,'','',0,46,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 16:53:36',NULL,1,1,'','',0,47,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 17:38:22',NULL,1,1,'','',0,48,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 19:09:24',2,1,1,'','',0,49,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 19:14:11',2,1,1,'','',0,50,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 19:17:30',2,1,1,'','',0,51,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 19:18:51',2,1,1,'','',0,52,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 19:19:58',2,1,1,'','',0,53,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 19:44:48',NULL,1,1,'','',0,54,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 19:46:48',2,1,1,'','',0,55,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 19:52:37',NULL,1,1,'','',0,56,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:09:10',2,1,1,'','',0,57,NULL,NULL,'Cash: $40.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,4.0000000000,40.0000000000,0.0000000000,40.0000000000,20.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4.0000000000,40.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:12:07',2,1,1,'','',0,58,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:27:12',3,1,1,'','',0,59,NULL,NULL,'Cash: $122.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,11.0000000000,122.0000000000,0.0000000000,122.0000000000,49.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11.0000000000,122.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:35:51',3,1,1,'','',0,60,NULL,NULL,'Cash: $12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:39:06',3,1,1,'','',0,61,NULL,NULL,'Cash: $12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:40:08',NULL,1,1,'','',0,62,NULL,NULL,'Cash: $12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:44:22',3,1,1,'','',0,63,NULL,NULL,'Cash: $12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:45:44',3,1,1,'','',0,64,NULL,NULL,'Cash: $12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:49:01',NULL,1,1,'','',0,65,NULL,NULL,'Cash: $12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-12 20:50:24',3,1,1,'','',0,66,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-13 12:56:32',2,1,1,'','',0,67,NULL,NULL,'Cash: $62.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,6.0000000000,62.0000000000,0.0000000000,62.0000000000,29.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,6.0000000000,62.0000000000,NULL,NULL,NULL,0),('2025-05-13 14:39:06',4,1,1,'','',0,68,NULL,NULL,'Cash: $122.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,3.0000000000,122.0000000000,0.0000000000,122.0000000000,2.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2.0000000000,122.0000000000,NULL,NULL,NULL,0),('2025-05-13 15:36:51',4,1,1,'','',0,69,NULL,NULL,'Cash: $50.00<br />Cash: <span style=\"white-space:nowrap;\">-</span>$8.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,42.0000000000,0.0000000000,42.0000000000,-3.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,42.0000000000,NULL,NULL,NULL,0),('2025-05-13 15:43:33',NULL,1,1,'','',0,70,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-13 15:51:21',2,1,1,'','',0,71,NULL,NULL,'Cash: $9.88<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,9.8800000000,0.0000000000,9.8800000000,1.8800000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,9.8800000000,NULL,NULL,NULL,0),('2025-05-13 16:06:40',4,1,1,'','',0,72,NULL,NULL,'Cash: $67.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,67.0000000000,0.0000000000,67.0000000000,0.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,67.0000000000,NULL,NULL,NULL,0),('2025-05-13 16:55:48',2,1,1,'','',0,73,NULL,NULL,'Cash: $5.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,5.0000000000,0.0000000000,5.0000000000,-3.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,5.0000000000,NULL,NULL,NULL,0),('2025-05-13 17:04:15',4,1,1,'','',0,74,NULL,NULL,'Cash: $5.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,5.0000000000,0.0000000000,5.0000000000,0.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,5.0000000000,NULL,NULL,NULL,0),('2025-05-13 17:09:37',4,1,1,'','',0,75,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-13 17:12:50',4,1,1,'','',0,76,NULL,NULL,'Cash: $8.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,8.0000000000,0.0000000000,8.0000000000,3.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,8.0000000000,NULL,NULL,NULL,0),('2025-05-13 18:54:23',4,1,1,'','',0,77,NULL,NULL,'Cash: $50.00<br />Cash: <span style=\"white-space:nowrap;\">-</span>$1.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,49.0000000000,0.0000000000,49.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,49.0000000000,NULL,NULL,NULL,0),('2025-05-13 19:30:05',4,1,1,'','Promocion',0,78,NULL,NULL,'Cash: $9.88<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,9.8800000000,0.0000000000,9.8800000000,1.8800000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,9.8800000000,NULL,NULL,NULL,0),('2025-05-13 19:58:36',2,1,1,'','',0,79,NULL,NULL,'Cash: $4.90<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,4.9000000000,0.0000000000,4.9000000000,-0.1000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,4.9000000000,NULL,NULL,NULL,0),('2025-05-13 20:04:58',4,1,1,'','',0,80,NULL,NULL,'Cash: $7.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,7.0000000000,0.0000000000,7.0000000000,-1.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,7.0000000000,NULL,NULL,NULL,0),('2025-05-13 20:34:08',4,1,1,'','',0,81,NULL,NULL,'Cash: $63.60<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,63.6000000000,0.0000000000,63.6000000000,-3.4000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,63.6000000000,NULL,NULL,NULL,0),('2025-05-14 13:02:04',4,1,1,'','',0,82,NULL,NULL,'Cash: $5.88<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,5.8800000000,0.0000000000,5.8800000000,-2.1200000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,5.8800000000,NULL,NULL,NULL,0),('2025-05-14 15:17:21',2,1,1,'','',0,83,NULL,NULL,'Cash: $18.78<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,2.0000000000,18.7800000000,0.0000000000,18.7800000000,5.7800000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,18.7800000000,NULL,NULL,NULL,0),('2025-05-15 12:29:50',3,1,1,'','',0,84,NULL,NULL,'Cash: $82.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,2.0000000000,82.0000000000,0.0000000000,82.0000000000,7.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2.0000000000,82.0000000000,NULL,NULL,NULL,0),('2025-05-15 14:34:23',3,1,1,'','',0,85,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-15 14:35:39',NULL,1,1,'','',0,86,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-15 14:37:21',4,1,1,'','',0,87,NULL,NULL,'Cash: $12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-15 14:50:14',3,1,1,'','',0,88,NULL,NULL,'Cash: $70.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,70.0000000000,NULL,NULL,NULL,0),('2025-05-15 14:55:13',NULL,1,1,'','',0,89,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-15 15:09:20',4,1,1,'','',0,90,NULL,NULL,'Cash: $7.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,7.0000000000,0.0000000000,7.0000000000,-1.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,7.0000000000,NULL,NULL,NULL,0),('2025-05-15 16:13:05',3,1,1,'','',0,91,NULL,NULL,'Cash: $64.60<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,64.6000000000,0.0000000000,64.6000000000,-2.4000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0000000000,64.6000000000,NULL,NULL,NULL,0),('2025-05-15 17:43:07',4,1,1,'','',0,92,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-15 18:34:45',2,1,1,'','',0,93,NULL,NULL,'Cash: $10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-15 18:36:37',3,1,1,'','',0,94,NULL,NULL,'Cash: $12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-15 18:51:27',4,1,1,'','',0,95,NULL,NULL,'Cash: $70.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,1.0000000000,'','$','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,70.0000000000,NULL,NULL,NULL,0),('2025-05-15 20:54:02',4,1,1,'','',0,96,NULL,NULL,'Efectivo: Bs117.60<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,2.0000000000,117.6000000000,0.0000000000,117.6000000000,5.6000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2.0000000000,117.6000000000,NULL,NULL,NULL,0),('2025-05-16 14:13:50',4,1,1,'','',0,97,NULL,NULL,'Efectivo: Bs70.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,70.0000000000,NULL,NULL,NULL,0),('2025-05-16 14:48:24',2,1,1,'','',0,98,NULL,NULL,'Efectivo: Bs70.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,70.0000000000,NULL,NULL,NULL,0),('2025-05-16 15:00:17',4,1,1,'','',0,99,NULL,NULL,'Efectivo: Bs11.76<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,11.7600000000,0.0000000000,11.7600000000,3.7600000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,11.7600000000,NULL,NULL,NULL,0),('2025-05-16 19:56:19',4,1,1,'','',0,100,NULL,NULL,'Efectivo: Bs70.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,70.0000000000,NULL,NULL,NULL,0),('2025-05-17 12:29:01',4,1,1,'','',0,101,NULL,NULL,'Efectivo: Bs70.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,70.0000000000,NULL,NULL,NULL,0),('2025-05-17 15:39:18',4,1,1,'','',0,102,NULL,NULL,'Efectivo: Bs11.64<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,11.6400000000,0.0000000000,11.6400000000,3.6400000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,11.6400000000,NULL,NULL,NULL,0),('2025-05-17 16:09:26',NULL,1,1,'','',0,103,NULL,NULL,'Efectivo: Bs12.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,12.0000000000,NULL,NULL,NULL,0),('2025-05-19 14:52:31',4,1,1,'','',0,104,NULL,NULL,'Efectivo: Bs9.90<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,9.9000000000,0.0000000000,9.9000000000,4.9000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,9.9000000000,NULL,NULL,NULL,0),('2025-05-19 15:47:09',3,1,1,'','',0,105,NULL,NULL,'Efectivo: Bs22.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,2.0000000000,22.0000000000,0.0000000000,22.0000000000,9.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2.0000000000,22.0000000000,NULL,NULL,NULL,0),('2025-05-19 15:49:58',NULL,1,1,'','',0,106,NULL,NULL,'Efectivo: Bs756.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,19.0000000000,756.0000000000,0.0000000000,756.0000000000,76.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19.0000000000,756.0000000000,NULL,NULL,NULL,0),('2025-05-19 16:55:47',3,1,1,'','',0,107,NULL,NULL,'Efectivo: Bs130.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,3.0000000000,130.0000000000,0.0000000000,130.0000000000,13.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3.0000000000,130.0000000000,NULL,NULL,NULL,0),('2025-05-20 20:30:42',4,1,1,'','',0,108,NULL,NULL,'Efectivo: Bs50.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,50.0000000000,0.0000000000,50.0000000000,5.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,50.0000000000,NULL,NULL,NULL,0),('2025-05-22 17:45:51',4,1,1,'','',0,109,NULL,NULL,'Efectivo: Bs10.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,10.0000000000,NULL,NULL,NULL,0),('2025-05-22 18:10:29',2,1,1,'','',0,110,NULL,NULL,'Efectivo: Bs49.50<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,49.5000000000,0.0000000000,49.5000000000,4.5000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,49.5000000000,NULL,NULL,NULL,0),('2025-05-22 20:07:41',4,1,1,'','',0,111,NULL,NULL,'Efectivo: Bs70.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1.0000000000,70.0000000000,NULL,NULL,NULL,0),('2025-05-23 15:21:50',4,1,1,'','',0,112,NULL,NULL,'Efectivo: Bs50.00<br />','','',NULL,0,0,0,NULL,'',0,0,0,1,1,NULL,0.0000000000,0.0000000000,0,NULL,NULL,1.0000000000,50.0000000000,0.0000000000,50.0000000000,5.0000000000,1.0000000000,'','Bs','before','',',','.',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-23 16:12:04',NULL,NULL,NULL,NULL,NULL,1.0000000000,50.0000000000,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `phppos_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_coupons`
--

DROP TABLE IF EXISTS `phppos_sales_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_sales_coupons_ibfk_1` (`sale_id`),
  KEY `phppos_sales_coupons_ibfk_2` (`rule_id`),
  CONSTRAINT `phppos_sales_coupons_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_coupons_ibfk_2` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_coupons`
--

LOCK TABLES `phppos_sales_coupons` WRITE;
/*!40000 ALTER TABLE `phppos_sales_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_deliveries`
--

DROP TABLE IF EXISTS `phppos_sales_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) DEFAULT NULL,
  `shipping_address_person_id` int(10) NOT NULL,
  `delivery_employee_person_id` int(10) DEFAULT NULL,
  `shipping_method_id` int(10) DEFAULT NULL,
  `shipping_zone_id` int(10) DEFAULT NULL,
  `tax_class_id` int(10) DEFAULT NULL,
  `status` int(30) DEFAULT NULL,
  `estimated_shipping_date` timestamp NULL DEFAULT NULL,
  `actual_shipping_date` timestamp NULL DEFAULT NULL,
  `estimated_delivery_or_pickup_date` timestamp NULL DEFAULT NULL,
  `actual_delivery_or_pickup_date` timestamp NULL DEFAULT NULL,
  `is_pickup` int(1) NOT NULL DEFAULT 0,
  `tracking_number` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `deleted` int(1) DEFAULT 0,
  `duration` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `delivery_type` varchar(15) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `contact_preference` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `search_index` (`status`,`shipping_address_person_id`),
  KEY `phppos_sales_deliveries_ibfk_1` (`sale_id`),
  KEY `phppos_sales_deliveries_ibfk_2` (`shipping_address_person_id`),
  KEY `phppos_sales_deliveries_ibfk_3` (`shipping_method_id`),
  KEY `phppos_sales_deliveries_ibfk_4` (`shipping_zone_id`),
  KEY `phppos_sales_deliveries_ibfk_5` (`tax_class_id`),
  KEY `deleted` (`deleted`),
  KEY `phppos_sales_deliveries_ibfk_6` (`delivery_employee_person_id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `phppos_sales_deliveries_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_deliveries_ibfk_2` FOREIGN KEY (`shipping_address_person_id`) REFERENCES `phppos_people` (`person_id`),
  CONSTRAINT `phppos_sales_deliveries_ibfk_3` FOREIGN KEY (`shipping_method_id`) REFERENCES `phppos_shipping_methods` (`id`),
  CONSTRAINT `phppos_sales_deliveries_ibfk_4` FOREIGN KEY (`shipping_zone_id`) REFERENCES `phppos_shipping_zones` (`id`),
  CONSTRAINT `phppos_sales_deliveries_ibfk_5` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`),
  CONSTRAINT `phppos_sales_deliveries_ibfk_6` FOREIGN KEY (`delivery_employee_person_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_sales_deliveries_ibfk_7` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`),
  CONSTRAINT `phppos_sales_deliveries_ibfk_8` FOREIGN KEY (`status`) REFERENCES `phppos_delivery_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_deliveries`
--

LOCK TABLES `phppos_sales_deliveries` WRITE;
/*!40000 ALTER TABLE `phppos_sales_deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_item_kits`
--

DROP TABLE IF EXISTS `phppos_sales_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_item_kits` (
  `sale_id` int(10) NOT NULL DEFAULT 0,
  `item_kit_id` int(10) NOT NULL DEFAULT 0,
  `rule_id` int(10) DEFAULT NULL,
  `rule_discount` decimal(23,10) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `line` int(11) NOT NULL DEFAULT 0,
  `quantity_purchased` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `quantity_received` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `item_kit_cost_price` decimal(23,10) NOT NULL,
  `item_kit_unit_price` decimal(23,10) NOT NULL,
  `regular_item_kit_unit_price_at_time_of_sale` decimal(23,10) DEFAULT NULL,
  `discount_percent` decimal(15,3) NOT NULL DEFAULT 0.000,
  `commission` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `subtotal` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `tax` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `total` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `profit` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `tier_id` int(10) DEFAULT NULL,
  `override_taxes` text DEFAULT NULL,
  `loyalty_multiplier` decimal(23,10) DEFAULT NULL,
  `receipt_line_sort_order` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `approved_by` int(10) DEFAULT NULL,
  `assigned_to` int(10) DEFAULT NULL,
  `is_repair_item` int(11) DEFAULT 0,
  PRIMARY KEY (`sale_id`,`item_kit_id`,`line`),
  KEY `item_kit_id` (`item_kit_id`),
  KEY `phppos_sales_item_kits_ibfk_3` (`rule_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `phppos_sales_item_kits_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_sales_item_kits_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_item_kits_ibfk_3` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_sales_item_kits_ibfk_4` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_item_kits`
--

LOCK TABLES `phppos_sales_item_kits` WRITE;
/*!40000 ALTER TABLE `phppos_sales_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_item_kits_modifier_items`
--

DROP TABLE IF EXISTS `phppos_sales_item_kits_modifier_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_item_kits_modifier_items` (
  `item_kit_id` int(10) NOT NULL,
  `sale_id` int(10) NOT NULL,
  `line` int(10) NOT NULL,
  `modifier_item_id` int(10) NOT NULL,
  `cost_price` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `unit_price` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  PRIMARY KEY (`item_kit_id`,`sale_id`,`line`,`modifier_item_id`),
  KEY `phppos_sales_item_kits_modifier_items_ibfk_2` (`sale_id`),
  KEY `phppos_sales_item_kits_modifier_items_ibfk_3` (`modifier_item_id`),
  CONSTRAINT `phppos_sales_item_kits_modifier_items_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`),
  CONSTRAINT `phppos_sales_item_kits_modifier_items_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_item_kits_modifier_items_ibfk_3` FOREIGN KEY (`modifier_item_id`) REFERENCES `phppos_modifier_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_item_kits_modifier_items`
--

LOCK TABLES `phppos_sales_item_kits_modifier_items` WRITE;
/*!40000 ALTER TABLE `phppos_sales_item_kits_modifier_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_item_kits_modifier_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_item_kits_taxes`
--

DROP TABLE IF EXISTS `phppos_sales_item_kits_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_item_kits_taxes` (
  `sale_id` int(10) NOT NULL,
  `item_kit_id` int(10) NOT NULL,
  `line` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sale_id`,`item_kit_id`,`line`,`name`,`percent`),
  KEY `item_id` (`item_kit_id`),
  CONSTRAINT `phppos_sales_item_kits_taxes_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales_item_kits` (`sale_id`),
  CONSTRAINT `phppos_sales_item_kits_taxes_ibfk_2` FOREIGN KEY (`item_kit_id`) REFERENCES `phppos_item_kits` (`item_kit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_item_kits_taxes`
--

LOCK TABLES `phppos_sales_item_kits_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_sales_item_kits_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_item_kits_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_items`
--

DROP TABLE IF EXISTS `phppos_sales_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_items` (
  `sale_id` int(10) NOT NULL DEFAULT 0,
  `item_id` int(10) NOT NULL DEFAULT 0,
  `item_variation_id` int(10) DEFAULT NULL,
  `rule_id` int(10) DEFAULT NULL,
  `rule_discount` decimal(23,10) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `serialnumber` varchar(255) DEFAULT NULL,
  `line` int(11) NOT NULL DEFAULT 0,
  `quantity_purchased` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `quantity_received` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `item_cost_price` decimal(23,10) NOT NULL,
  `item_unit_price` decimal(23,10) NOT NULL,
  `regular_item_unit_price_at_time_of_sale` decimal(23,10) DEFAULT NULL,
  `discount_percent` decimal(15,3) NOT NULL DEFAULT 0.000,
  `commission` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `subtotal` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `tax` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `total` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `profit` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `tier_id` int(10) DEFAULT NULL,
  `series_id` int(11) DEFAULT NULL,
  `damaged_qty` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `override_taxes` text DEFAULT NULL,
  `unit_quantity` decimal(23,10) DEFAULT NULL,
  `items_quantity_units_id` int(11) DEFAULT NULL,
  `loyalty_multiplier` decimal(23,10) DEFAULT NULL,
  `receipt_line_sort_order` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `approved_by` int(10) DEFAULT NULL,
  `assigned_to` int(10) DEFAULT NULL,
  `is_repair_item` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sale_id`,`item_id`,`line`),
  KEY `item_id` (`item_id`),
  KEY `phppos_sales_items_ibfk_3` (`rule_id`),
  KEY `phppos_sales_items_ibfk_4` (`item_variation_id`),
  KEY `phppos_sales_items_ibfk_5` (`series_id`),
  KEY `phppos_sales_items_ibfk_6` (`items_quantity_units_id`),
  KEY `serialnumber` (`serialnumber`),
  KEY `supplier_id` (`supplier_id`),
  KEY `phppos_sales_items_ibfk_8` (`approved_by`),
  KEY `phppos_sales_items_ibfk_9` (`assigned_to`),
  CONSTRAINT `phppos_sales_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_sales_items_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_items_ibfk_3` FOREIGN KEY (`rule_id`) REFERENCES `phppos_price_rules` (`id`),
  CONSTRAINT `phppos_sales_items_ibfk_4` FOREIGN KEY (`item_variation_id`) REFERENCES `phppos_item_variations` (`id`),
  CONSTRAINT `phppos_sales_items_ibfk_5` FOREIGN KEY (`series_id`) REFERENCES `phppos_customers_series` (`id`),
  CONSTRAINT `phppos_sales_items_ibfk_6` FOREIGN KEY (`items_quantity_units_id`) REFERENCES `phppos_items_quantity_units` (`id`),
  CONSTRAINT `phppos_sales_items_ibfk_7` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`),
  CONSTRAINT `phppos_sales_items_ibfk_8` FOREIGN KEY (`approved_by`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_sales_items_ibfk_9` FOREIGN KEY (`assigned_to`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_items`
--

LOCK TABLES `phppos_sales_items` WRITE;
/*!40000 ALTER TABLE `phppos_sales_items` DISABLE KEYS */;
INSERT INTO `phppos_sales_items` VALUES (1,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(2,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(3,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(4,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(5,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(6,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(7,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(8,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(9,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(10,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(11,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(12,1,NULL,NULL,NULL,'',NULL,0,2.0000000000,2.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,20.0000000000,0.0000000000,20.0000000000,10.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(13,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(14,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(15,1,NULL,NULL,NULL,'',NULL,0,5.0000000000,5.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,25.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(16,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(17,1,NULL,NULL,NULL,'',NULL,0,2.0000000000,2.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,20.0000000000,0.0000000000,20.0000000000,10.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(18,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(19,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(20,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(21,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(22,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(23,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(24,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(25,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(26,1,NULL,NULL,NULL,'',NULL,0,5.0000000000,5.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,25.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(27,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(28,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(29,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(30,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(31,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(32,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(33,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(34,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(35,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(36,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(37,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(38,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(39,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(40,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(41,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(42,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(43,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(44,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(45,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(46,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(47,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(48,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(49,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(50,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(51,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(52,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(53,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(54,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(55,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(56,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(57,1,NULL,NULL,NULL,'',NULL,0,4.0000000000,4.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,40.0000000000,0.0000000000,40.0000000000,20.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(58,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(59,1,NULL,NULL,NULL,'',NULL,0,5.0000000000,5.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,25.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(59,2,NULL,NULL,NULL,'',NULL,1,6.0000000000,6.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,72.0000000000,0.0000000000,72.0000000000,24.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(60,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(61,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(62,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(63,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(64,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(65,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(66,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(67,1,NULL,NULL,NULL,'',NULL,0,5.0000000000,5.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,25.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(67,2,NULL,NULL,NULL,'',NULL,1,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(68,2,NULL,NULL,NULL,'',NULL,1,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(68,4,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,45.0000000000,50.0000000000,50.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(68,6,NULL,NULL,NULL,'',NULL,2,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,3,NULL,NULL,NULL,0),(68,7,NULL,NULL,NULL,'',NULL,3,-1.0000000000,-1.0000000000,0.0000000000,10.0000000000,0.0000000000,0.000,0.0000000000,-10.0000000000,0.0000000000,-10.0000000000,-10.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,4,NULL,NULL,NULL,0),(69,4,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,45.0000000000,50.0000000000,50.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(69,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,8.0000000000,0.0000000000,0.000,0.0000000000,-8.0000000000,0.0000000000,-8.0000000000,-8.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(70,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(71,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,1.000,0.0000000000,11.8800000000,0.0000000000,11.8800000000,3.8800000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(71,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,2.0000000000,0.0000000000,0.000,0.0000000000,-2.0000000000,0.0000000000,-2.0000000000,-2.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,3,NULL,NULL,NULL,0),(72,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(72,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,3.0000000000,0.0000000000,0.000,0.0000000000,-3.0000000000,0.0000000000,-3.0000000000,-3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(73,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(73,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,7.0000000000,0.0000000000,0.000,0.0000000000,-7.0000000000,0.0000000000,-7.0000000000,-7.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(74,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(74,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,5.0000000000,0.0000000000,0.000,0.0000000000,-5.0000000000,0.0000000000,-5.0000000000,-5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(75,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(76,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(76,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,2.0000000000,0.0000000000,0.000,0.0000000000,-2.0000000000,0.0000000000,-2.0000000000,-2.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(77,4,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,45.0000000000,50.0000000000,50.0000000000,2.000,0.0000000000,49.0000000000,0.0000000000,49.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(78,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,1.000,0.0000000000,11.8800000000,0.0000000000,11.8800000000,3.8800000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(78,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,2.0000000000,0.0000000000,0.000,0.0000000000,-2.0000000000,0.0000000000,-2.0000000000,-2.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(79,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,1.000,0.0000000000,9.9000000000,0.0000000000,9.9000000000,4.9000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(79,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,5.0000000000,0.0000000000,0.000,0.0000000000,-5.0000000000,0.0000000000,-5.0000000000,-5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(80,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(80,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,5.0000000000,0.0000000000,0.000,0.0000000000,-5.0000000000,0.0000000000,-5.0000000000,-5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(81,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,2.000,0.0000000000,68.6000000000,0.0000000000,68.6000000000,1.6000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(81,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,5.0000000000,0.0000000000,0.000,0.0000000000,-5.0000000000,0.0000000000,-5.0000000000,-5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(82,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,1.000,0.0000000000,11.8800000000,0.0000000000,11.8800000000,3.8800000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(82,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,6.0000000000,0.0000000000,0.000,0.0000000000,-6.0000000000,0.0000000000,-6.0000000000,-6.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(83,1,NULL,NULL,NULL,'',NULL,1,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,1.000,0.0000000000,9.9000000000,0.0000000000,9.9000000000,4.9000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(83,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,1.000,0.0000000000,11.8800000000,0.0000000000,11.8800000000,3.8800000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(83,7,NULL,NULL,NULL,'',NULL,2,-1.0000000000,-1.0000000000,0.0000000000,3.0000000000,0.0000000000,0.000,0.0000000000,-3.0000000000,0.0000000000,-3.0000000000,-3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,4,NULL,NULL,NULL,0),(84,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(84,6,NULL,NULL,NULL,'',NULL,1,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(85,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(86,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(87,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(88,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(89,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(90,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(90,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,5.0000000000,0.0000000000,0.000,0.0000000000,-5.0000000000,0.0000000000,-5.0000000000,-5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(91,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,2.000,0.0000000000,68.6000000000,0.0000000000,68.6000000000,1.6000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(91,7,NULL,NULL,NULL,'',NULL,1,-1.0000000000,-1.0000000000,0.0000000000,4.0000000000,0.0000000000,0.000,0.0000000000,-4.0000000000,0.0000000000,-4.0000000000,-4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(92,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(93,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(94,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(95,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(96,4,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,45.0000000000,50.0000000000,50.0000000000,2.000,0.0000000000,49.0000000000,0.0000000000,49.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(96,6,NULL,NULL,NULL,'',NULL,1,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,2.000,0.0000000000,68.6000000000,0.0000000000,68.6000000000,1.6000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(97,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(98,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(99,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,2.000,0.0000000000,11.7600000000,0.0000000000,11.7600000000,3.7600000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(100,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(101,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(102,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,3.000,0.0000000000,11.6400000000,0.0000000000,11.6400000000,3.6400000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(103,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(104,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,1.000,0.0000000000,9.9000000000,0.0000000000,9.9000000000,4.9000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(105,1,NULL,NULL,NULL,'',NULL,1,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(105,2,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,12.0000000000,0.0000000000,12.0000000000,4.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(106,1,NULL,NULL,NULL,'',NULL,3,6.0000000000,6.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,60.0000000000,0.0000000000,60.0000000000,30.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,4,NULL,NULL,NULL,0),(106,2,NULL,NULL,NULL,'',NULL,2,3.0000000000,3.0000000000,8.0000000000,12.0000000000,12.0000000000,0.000,0.0000000000,36.0000000000,0.0000000000,36.0000000000,12.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,3,NULL,NULL,NULL,0),(106,4,NULL,NULL,NULL,'',NULL,1,2.0000000000,2.0000000000,45.0000000000,50.0000000000,50.0000000000,0.000,0.0000000000,100.0000000000,0.0000000000,100.0000000000,10.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(106,6,NULL,NULL,NULL,'',NULL,0,8.0000000000,8.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,560.0000000000,0.0000000000,560.0000000000,24.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(107,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(107,4,NULL,NULL,NULL,'',NULL,2,1.0000000000,1.0000000000,45.0000000000,50.0000000000,50.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,3,NULL,NULL,NULL,0),(107,6,NULL,NULL,NULL,'',NULL,1,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,2,NULL,NULL,NULL,0),(108,4,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,45.0000000000,50.0000000000,50.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(109,1,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,5.0000000000,10.0000000000,10.0000000000,0.000,0.0000000000,10.0000000000,0.0000000000,10.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(110,4,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,45.0000000000,50.0000000000,50.0000000000,1.000,0.0000000000,49.5000000000,0.0000000000,49.5000000000,4.5000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(111,6,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,67.0000000000,70.0000000000,70.0000000000,0.000,0.0000000000,70.0000000000,0.0000000000,70.0000000000,3.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0),(112,4,NULL,NULL,NULL,'',NULL,0,1.0000000000,1.0000000000,45.0000000000,50.0000000000,50.0000000000,0.000,0.0000000000,50.0000000000,0.0000000000,50.0000000000,5.0000000000,NULL,NULL,0.0000000000,NULL,NULL,NULL,1.0000000000,1,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `phppos_sales_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_items_modifier_items`
--

DROP TABLE IF EXISTS `phppos_sales_items_modifier_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_items_modifier_items` (
  `item_id` int(10) NOT NULL,
  `sale_id` int(10) NOT NULL,
  `line` int(10) NOT NULL,
  `modifier_item_id` int(10) NOT NULL,
  `cost_price` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `unit_price` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  PRIMARY KEY (`item_id`,`sale_id`,`line`,`modifier_item_id`),
  KEY `phppos_sales_items_modifier_items_ibfk_2` (`sale_id`),
  KEY `phppos_sales_items_modifier_items_ibfk_3` (`modifier_item_id`),
  CONSTRAINT `phppos_sales_items_modifier_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_sales_items_modifier_items_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_items_modifier_items_ibfk_3` FOREIGN KEY (`modifier_item_id`) REFERENCES `phppos_modifier_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_items_modifier_items`
--

LOCK TABLES `phppos_sales_items_modifier_items` WRITE;
/*!40000 ALTER TABLE `phppos_sales_items_modifier_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_items_modifier_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_items_notes`
--

DROP TABLE IF EXISTS `phppos_sales_items_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_items_notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(10) NOT NULL DEFAULT 0,
  `item_variation_id` int(10) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `detailed_notes` text DEFAULT NULL,
  `internal` tinyint(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL,
  `images` text DEFAULT NULL,
  `device_location` varchar(255) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  PRIMARY KEY (`note_id`),
  KEY `phppos_sales_items_notes_ibfk_1` (`sale_id`),
  KEY `phppos_sales_items_notes_ibfk_2` (`item_id`),
  KEY `phppos_sales_items_notes_ibfk_3` (`employee_id`),
  KEY `phppos_sales_items_notes_ibfk_4` (`status`),
  CONSTRAINT `phppos_sales_items_notes_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_items_notes_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`),
  CONSTRAINT `phppos_sales_items_notes_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_sales_items_notes_ibfk_4` FOREIGN KEY (`status`) REFERENCES `phppos_workorder_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_items_notes`
--

LOCK TABLES `phppos_sales_items_notes` WRITE;
/*!40000 ALTER TABLE `phppos_sales_items_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_items_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_items_taxes`
--

DROP TABLE IF EXISTS `phppos_sales_items_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_items_taxes` (
  `sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sale_id`,`item_id`,`line`,`name`,`percent`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `phppos_sales_items_taxes_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales_items` (`sale_id`),
  CONSTRAINT `phppos_sales_items_taxes_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `phppos_items` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_items_taxes`
--

LOCK TABLES `phppos_sales_items_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_sales_items_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_items_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_payments`
--

DROP TABLE IF EXISTS `phppos_sales_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_amount` decimal(23,10) NOT NULL,
  `auth_code` varchar(255) DEFAULT '',
  `ref_no` varchar(255) DEFAULT '',
  `cc_token` varchar(255) DEFAULT '',
  `acq_ref_data` varchar(255) DEFAULT '',
  `process_data` varchar(255) DEFAULT '',
  `entry_method` varchar(255) DEFAULT '',
  `aid` varchar(255) DEFAULT '',
  `tvr` varchar(255) DEFAULT '',
  `iad` varchar(255) DEFAULT '',
  `tsi` varchar(255) DEFAULT '',
  `arc` varchar(255) DEFAULT '',
  `cvm` varchar(255) DEFAULT '',
  `tran_type` varchar(255) DEFAULT '',
  `application_label` varchar(255) DEFAULT '',
  `truncated_card` varchar(255) DEFAULT '',
  `card_issuer` varchar(255) DEFAULT '',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ebt_auth_code` varchar(255) DEFAULT '',
  `ebt_voucher_no` varchar(255) DEFAULT '',
  PRIMARY KEY (`payment_id`),
  KEY `sale_id` (`sale_id`),
  KEY `payment_date` (`payment_date`),
  CONSTRAINT `phppos_sales_payments_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_payments`
--

LOCK TABLES `phppos_sales_payments` WRITE;
/*!40000 ALTER TABLE `phppos_sales_payments` DISABLE KEYS */;
INSERT INTO `phppos_sales_payments` VALUES (1,1,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-08 21:02:20',NULL,NULL),(2,2,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 15:07:34',NULL,NULL),(3,3,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 15:24:02',NULL,NULL),(4,4,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 15:25:24',NULL,NULL),(5,5,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 15:26:08',NULL,NULL),(6,6,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 15:30:11',NULL,NULL),(7,7,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 15:40:33',NULL,NULL),(8,8,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 15:47:05',NULL,NULL),(9,9,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 15:54:52',NULL,NULL),(10,10,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 16:47:22',NULL,NULL),(11,11,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 17:40:58',NULL,NULL),(12,12,'Cash',20.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 17:50:06',NULL,NULL),(13,13,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 17:53:23',NULL,NULL),(14,14,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 18:11:34',NULL,NULL),(15,15,'Cash',50.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 18:17:57',NULL,NULL),(16,16,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 18:22:13',NULL,NULL),(17,17,'Cash',20.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 18:29:35',NULL,NULL),(18,18,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 18:32:51',NULL,NULL),(19,19,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 18:37:32',NULL,NULL),(20,20,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 18:41:17',NULL,NULL),(21,21,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 19:07:18',NULL,NULL),(22,22,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 19:17:20',NULL,NULL),(23,23,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 19:38:25',NULL,NULL),(24,24,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 20:02:25',NULL,NULL),(25,25,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 20:07:27',NULL,NULL),(26,26,'Cash',50.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-09 20:17:28',NULL,NULL),(27,27,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-10 12:15:52',NULL,NULL),(28,28,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-10 12:48:32',NULL,NULL),(29,29,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-10 12:49:21',NULL,NULL),(30,30,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-10 12:57:27',NULL,NULL),(31,31,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-10 13:13:28',NULL,NULL),(32,32,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-10 13:26:25',NULL,NULL),(33,33,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-10 16:48:28',NULL,NULL),(34,34,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 12:45:11',NULL,NULL),(35,35,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 14:07:31',NULL,NULL),(36,36,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 14:08:54',NULL,NULL),(37,37,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 14:10:39',NULL,NULL),(38,38,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 15:38:45',NULL,NULL),(39,39,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 15:38:45',NULL,NULL),(40,40,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 15:38:45',NULL,NULL),(41,41,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 16:13:17',NULL,NULL),(42,42,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 16:26:10',NULL,NULL),(43,43,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 16:26:10',NULL,NULL),(44,44,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 16:29:36',NULL,NULL),(45,45,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 16:34:31',NULL,NULL),(46,46,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 16:41:03',NULL,NULL),(47,47,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 16:53:29',NULL,NULL),(48,48,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 17:38:17',NULL,NULL),(49,49,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 19:09:21',NULL,NULL),(50,50,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 19:14:08',NULL,NULL),(51,51,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 19:17:27',NULL,NULL),(52,52,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 19:18:37',NULL,NULL),(53,53,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 19:19:55',NULL,NULL),(54,54,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 19:44:45',NULL,NULL),(55,55,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 19:46:45',NULL,NULL),(56,56,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 19:52:34',NULL,NULL),(57,57,'Cash',40.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:09:07',NULL,NULL),(58,58,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:12:05',NULL,NULL),(59,59,'Cash',122.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:27:09',NULL,NULL),(60,60,'Cash',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:35:48',NULL,NULL),(61,61,'Cash',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:39:02',NULL,NULL),(62,62,'Cash',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:40:06',NULL,NULL),(63,63,'Cash',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:44:19',NULL,NULL),(64,64,'Cash',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:45:41',NULL,NULL),(65,65,'Cash',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:48:59',NULL,NULL),(66,66,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-12 20:50:22',NULL,NULL),(67,67,'Cash',62.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 12:56:20',NULL,NULL),(68,68,'Cash',122.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 14:39:03',NULL,NULL),(69,69,'Cash',50.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 15:33:12',NULL,NULL),(70,69,'Cash',-8.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 15:36:48',NULL,NULL),(71,70,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 15:43:30',NULL,NULL),(72,71,'Cash',9.8800000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 15:51:17',NULL,NULL),(73,72,'Cash',67.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 16:06:37',NULL,NULL),(74,73,'Cash',5.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 16:55:45',NULL,NULL),(75,74,'Cash',5.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 17:04:10',NULL,NULL),(76,75,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 17:09:34',NULL,NULL),(77,76,'Cash',8.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 17:12:47',NULL,NULL),(78,77,'Cash',50.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 18:54:07',NULL,NULL),(79,77,'Cash',-1.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 18:54:19',NULL,NULL),(80,78,'Cash',9.8800000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 19:30:02',NULL,NULL),(81,79,'Cash',4.9000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 19:58:30',NULL,NULL),(82,80,'Cash',7.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 20:04:55',NULL,NULL),(83,81,'Cash',63.6000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-13 20:34:03',NULL,NULL),(84,82,'Cash',5.8800000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-14 13:01:59',NULL,NULL),(85,83,'Cash',18.7800000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-14 15:17:18',NULL,NULL),(86,84,'Cash',82.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 12:29:40',NULL,NULL),(87,85,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 14:34:18',NULL,NULL),(88,86,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 14:35:36',NULL,NULL),(89,87,'Cash',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 14:37:19',NULL,NULL),(90,88,'Cash',70.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 14:50:11',NULL,NULL),(91,89,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 14:55:10',NULL,NULL),(92,90,'Cash',7.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 15:09:17',NULL,NULL),(93,91,'Cash',64.6000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 16:13:02',NULL,NULL),(94,92,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 17:43:05',NULL,NULL),(95,93,'Cash',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 18:34:39',NULL,NULL),(96,94,'Cash',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 18:36:33',NULL,NULL),(97,95,'Cash',70.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 18:51:24',NULL,NULL),(98,96,'Efectivo',117.6000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-15 20:53:58',NULL,NULL),(99,97,'Efectivo',70.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-16 14:13:47',NULL,NULL),(100,98,'Efectivo',70.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-16 14:48:21',NULL,NULL),(101,99,'Efectivo',11.7600000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-16 15:00:14',NULL,NULL),(102,100,'Efectivo',70.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-16 19:56:15',NULL,NULL),(103,101,'Efectivo',70.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-17 12:28:54',NULL,NULL),(104,102,'Efectivo',11.6400000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-17 15:39:12',NULL,NULL),(105,103,'Efectivo',12.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-17 16:09:23',NULL,NULL),(106,104,'Efectivo',9.9000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-19 14:52:28',NULL,NULL),(107,105,'Efectivo',22.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-19 15:47:06',NULL,NULL),(108,106,'Efectivo',756.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-19 15:49:55',NULL,NULL),(109,107,'Efectivo',130.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-19 16:55:45',NULL,NULL),(110,108,'Efectivo',50.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-20 20:30:39',NULL,NULL),(111,109,'Efectivo',10.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-22 17:45:47',NULL,NULL),(112,110,'Efectivo',49.5000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-22 18:10:27',NULL,NULL),(113,111,'Efectivo',70.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-22 20:07:38',NULL,NULL),(116,112,'Efectivo',50.0000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-23 15:21:50',NULL,NULL);
/*!40000 ALTER TABLE `phppos_sales_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sales_work_orders`
--

DROP TABLE IF EXISTS `phppos_sales_work_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sales_work_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) NOT NULL,
  `status` int(11) DEFAULT 1,
  `employee_id` int(11) DEFAULT NULL,
  `estimated_repair_date` timestamp NULL DEFAULT NULL,
  `estimated_parts` decimal(23,10) DEFAULT NULL,
  `estimated_labor` decimal(23,10) DEFAULT NULL,
  `warranty` tinyint(1) DEFAULT NULL,
  `custom_field_1_value` varchar(255) DEFAULT NULL,
  `custom_field_2_value` varchar(255) DEFAULT NULL,
  `custom_field_3_value` varchar(255) DEFAULT NULL,
  `custom_field_4_value` varchar(255) DEFAULT NULL,
  `custom_field_5_value` varchar(255) DEFAULT NULL,
  `custom_field_6_value` varchar(255) DEFAULT NULL,
  `custom_field_7_value` varchar(255) DEFAULT NULL,
  `custom_field_8_value` varchar(255) DEFAULT NULL,
  `custom_field_9_value` varchar(255) DEFAULT NULL,
  `custom_field_10_value` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `deleted` int(1) DEFAULT 0,
  `pre_auth_signature_file_id` int(11) DEFAULT NULL,
  `post_auth_signature_file_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_field_1_value` (`custom_field_1_value`),
  KEY `custom_field_2_value` (`custom_field_2_value`),
  KEY `custom_field_3_value` (`custom_field_3_value`),
  KEY `custom_field_4_value` (`custom_field_4_value`),
  KEY `custom_field_5_value` (`custom_field_5_value`),
  KEY `custom_field_6_value` (`custom_field_6_value`),
  KEY `custom_field_7_value` (`custom_field_7_value`),
  KEY `custom_field_8_value` (`custom_field_8_value`),
  KEY `custom_field_9_value` (`custom_field_9_value`),
  KEY `custom_field_10_value` (`custom_field_10_value`),
  KEY `phppos_sales_work_orders_ibfk_1` (`sale_id`),
  KEY `phppos_sales_work_orders_ibfk_2` (`employee_id`),
  KEY `phppos_sales_work_orders_ibfk_3` (`status`),
  KEY `phppos_sales_work_orders_ibfk_4` (`pre_auth_signature_file_id`),
  KEY `phppos_sales_work_orders_ibfk_5` (`post_auth_signature_file_id`),
  CONSTRAINT `phppos_sales_work_orders_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_sales_work_orders_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`),
  CONSTRAINT `phppos_sales_work_orders_ibfk_3` FOREIGN KEY (`status`) REFERENCES `phppos_workorder_statuses` (`id`),
  CONSTRAINT `phppos_sales_work_orders_ibfk_4` FOREIGN KEY (`pre_auth_signature_file_id`) REFERENCES `phppos_app_files` (`file_id`),
  CONSTRAINT `phppos_sales_work_orders_ibfk_5` FOREIGN KEY (`post_auth_signature_file_id`) REFERENCES `phppos_app_files` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sales_work_orders`
--

LOCK TABLES `phppos_sales_work_orders` WRITE;
/*!40000 ALTER TABLE `phppos_sales_work_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_sales_work_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sessions`
--

DROP TABLE IF EXISTS `phppos_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sessions`
--

LOCK TABLES `phppos_sessions` WRITE;
/*!40000 ALTER TABLE `phppos_sessions` DISABLE KEYS */;
INSERT INTO `phppos_sessions` VALUES ('6sjes8qeapmq11f2u0n7m530g3ht4sfo','::1',1747918628,_binary 'person_id|s:1:\"1\";'),('8b718ag0pm33vkbuqrcbuiuibn2n5hlj','::1',1748033030,_binary 'person_id|s:1:\"1\";sale|s:2603:\"O:14:\"PHPPOSCartSale\":83:{s:7:\"sale_id\";N;s:14:\"return_sale_id\";N;s:11:\"ref_sale_id\";N;s:13:\"ref_sale_desc\";s:0:\"\";s:11:\"customer_id\";N;s:23:\"show_comment_on_receipt\";b:0;s:16:\"selected_tier_id\";i:0;s:16:\"previous_tier_id\";i:0;s:19:\"sold_by_employee_id\";s:1:\"1\";s:15:\"discount_reason\";s:0:\"\";s:12:\"has_delivery\";b:0;s:8:\"delivery\";O:18:\"PHPPOSCartDelivery\":3:{s:13:\"delivery_info\";N;s:21:\"delivery_tax_group_id\";N;s:20:\"delivery_person_info\";N;}s:20:\"partial_transactions\";a:0:{}s:17:\"use_cc_saved_info\";b:0;s:10:\"invoice_no\";s:0:\"\";s:15:\"prompt_for_card\";b:0;s:11:\"ebt_voucher\";s:0:\"\";s:14:\"ebt_voucher_no\";s:0:\"\";s:13:\"ebt_auth_code\";s:0:\"\";s:21:\"save_credit_card_info\";b:0;s:17:\"use_saved_cc_info\";b:0;s:15:\"redeem_discount\";b:0;s:21:\"sale_exchange_details\";s:0:\"\";s:7:\"coupons\";a:0:{}s:12:\"is_ecommerce\";b:0;s:29:\"integrated_gift_card_balances\";a:0:{}s:3:\"age\";N;s:12:\"taxjar_taxes\";a:0:{}s:22:\"was_last_edit_quantity\";b:0;s:25:\"show_terms_and_conditions\";s:0:\"\";s:24:\"customer_subscription_id\";N;s:17:\"create_work_order\";i:0;s:13:\"is_work_order\";b:0;s:13:\"return_reason\";N;s:19:\"\0PHPPOSCart\0cart_id\";s:4:\"sale\";s:22:\"\0PHPPOSCart\0cart_items\";a:0:{}s:20:\"\0PHPPOSCart\0payments\";a:0:{}s:26:\"\0PHPPOSCart\0excluded_taxes\";a:0:{}s:16:\"\0PHPPOSCart\0mode\";s:4:\"sale\";s:34:\"\0PHPPOSCart\0paid_store_account_ids\";a:0:{}s:26:\"paid_store_account_amounts\";a:0:{}s:11:\"employee_id\";N;s:11:\"location_id\";N;s:11:\"register_id\";N;s:7:\"comment\";s:0:\"\";s:16:\"selected_payment\";s:0:\"\";s:13:\"email_receipt\";b:0;s:11:\"sms_receipt\";b:0;s:9:\"suspended\";i:0;s:18:\"change_date_enable\";b:0;s:16:\"change_cart_date\";N;s:19:\"is_editing_previous\";b:0;s:20:\"custom_field_1_value\";N;s:20:\"custom_field_2_value\";N;s:20:\"custom_field_3_value\";N;s:20:\"custom_field_4_value\";N;s:20:\"custom_field_5_value\";N;s:20:\"custom_field_6_value\";N;s:20:\"custom_field_7_value\";N;s:20:\"custom_field_8_value\";N;s:20:\"custom_field_9_value\";N;s:21:\"custom_field_10_value\";N;s:31:\"work_order_custom_field_1_value\";N;s:31:\"work_order_custom_field_2_value\";N;s:31:\"work_order_custom_field_3_value\";N;s:31:\"work_order_custom_field_4_value\";N;s:31:\"work_order_custom_field_5_value\";N;s:31:\"work_order_custom_field_6_value\";N;s:31:\"work_order_custom_field_7_value\";N;s:31:\"work_order_custom_field_8_value\";N;s:31:\"work_order_custom_field_9_value\";N;s:32:\"work_order_custom_field_10_value\";N;s:18:\"override_tax_names\";N;s:21:\"override_tax_percents\";N;s:24:\"override_tax_cumulatives\";N;s:18:\"override_tax_class\";N;s:17:\"details_collapsed\";b:0;s:12:\"skip_webhook\";b:0;s:6:\"offset\";i:0;s:5:\"limit\";i:20;s:11:\"sort_column\";N;s:9:\"sort_type\";N;s:14:\"create_invoice\";N;}\";employee_current_register_id|s:1:\"1\";foreign_language_to_cur_language_sales|a:95:{s:6:\"كاش\";s:8:\"Efectivo\";s:6:\"شيك\";s:6:\"Cheque\";s:15:\"كرت هدية\";s:17:\"Tarjeta de regalo\";s:23:\"بطاقة ائتمان\";s:18:\"Tarjeta de débito\";s:27:\"بطاقة الائتمان\";s:19:\"Tarjeta de crédito\";s:21:\"حساب المتجر\";s:18:\"Línea de crédito\";s:8:\"نقاط\";s:6:\"Puntos\";s:6:\"现金\";s:8:\"Efectivo\";s:6:\"检查\";s:6:\"Cheque\";s:9:\"礼物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借记卡\";s:18:\"Tarjeta de débito\";s:9:\"信用卡\";s:19:\"Tarjeta de crédito\";s:12:\"商店帐号\";s:18:\"Línea de crédito\";s:3:\"点\";s:6:\"Puntos\";s:6:\"現金\";s:8:\"Efectivo\";s:6:\"檢查\";s:6:\"Cheque\";s:9:\"禮物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借記卡\";s:18:\"Tarjeta de débito\";s:12:\"商店帳號\";s:18:\"Línea de crédito\";s:3:\"點\";s:6:\"Puntos\";s:7:\"Contant\";s:8:\"Efectivo\";s:6:\"Cheque\";s:6:\"Cheque\";s:9:\"Waardebon\";s:17:\"Tarjeta de regalo\";s:9:\"Bankkaart\";s:18:\"Tarjeta de débito\";s:12:\"Kredietkaart\";s:19:\"Tarjeta de crédito\";s:11:\"Op rekening\";s:18:\"Línea de crédito\";s:6:\"Punten\";s:6:\"Puntos\";s:4:\"Cash\";s:8:\"Efectivo\";s:5:\"Check\";s:6:\"Cheque\";s:9:\"Gift Card\";s:17:\"Tarjeta de regalo\";s:10:\"Debit Card\";s:18:\"Tarjeta de débito\";s:11:\"Credit Card\";s:19:\"Tarjeta de crédito\";s:13:\"Store Account\";s:18:\"Línea de crédito\";s:6:\"Points\";s:6:\"Puntos\";s:8:\"Comptant\";s:8:\"Efectivo\";s:7:\"Chèque\";s:6:\"Cheque\";s:12:\"Carte cadeau\";s:17:\"Tarjeta de regalo\";s:12:\"Carte débit\";s:18:\"Tarjeta de débito\";s:12:\"Carte credit\";s:19:\"Tarjeta de crédito\";s:14:\"Compte magasin\";s:18:\"Línea de crédito\";s:10:\"Des points\";s:6:\"Puntos\";s:7:\"Bargeld\";s:8:\"Efectivo\";s:6:\"Scheck\";s:6:\"Cheque\";s:9:\"Gutschein\";s:17:\"Tarjeta de regalo\";s:11:\"Kundenkarte\";s:18:\"Tarjeta de débito\";s:11:\"Kreditkarte\";s:19:\"Tarjeta de crédito\";s:13:\"Laden-Account\";s:18:\"Línea de crédito\";s:6:\"Punkte\";s:6:\"Puntos\";s:5:\"Tunai\";s:8:\"Efectivo\";s:3:\"Cek\";s:6:\"Cheque\";s:12:\"Hadiah Kartu\";s:17:\"Tarjeta de regalo\";s:11:\"Kartu Debit\";s:18:\"Tarjeta de débito\";s:12:\"Kartu Credit\";s:19:\"Tarjeta de crédito\";s:9:\"Toko Akun\";s:18:\"Línea de crédito\";s:4:\"Poin\";s:6:\"Puntos\";s:8:\"Contante\";s:8:\"Efectivo\";s:7:\"Assegno\";s:6:\"Cheque\";s:12:\"Buono Regalo\";s:17:\"Tarjeta de regalo\";s:8:\"Bancomat\";s:18:\"Tarjeta de débito\";s:16:\"Carta di Credito\";s:19:\"Tarjeta de crédito\";s:14:\"Conto deposito\";s:18:\"Línea de crédito\";s:5:\"Punti\";s:6:\"Puntos\";s:30:\"សាច់ប្រាក់\";s:8:\"Efectivo\";s:9:\"សែក\";s:6:\"Cheque\";s:33:\"កាត​រង្វាន់\";s:17:\"Tarjeta de regalo\";s:36:\"ប័ណ្ណ​ឥណពន្ធ\";s:18:\"Tarjeta de débito\";s:33:\"ប័ណ្ណ​ឥណទាន\";s:19:\"Tarjeta de crédito\";s:36:\"ប្រាក់ជំពាក់\";s:18:\"Línea de crédito\";s:18:\"ពិន្ទុ\";s:6:\"Puntos\";s:10:\"Numerário\";s:8:\"Efectivo\";s:14:\"Vale de Oferta\";s:17:\"Tarjeta de regalo\";s:18:\"Cartão de Débito\";s:18:\"Tarjeta de débito\";s:19:\"Cartão de Crédito\";s:19:\"Tarjeta de crédito\";s:13:\"Conta da Loja\";s:18:\"Línea de crédito\";s:6:\"Pontos\";s:6:\"Puntos\";s:8:\"Efectivo\";s:8:\"Efectivo\";s:17:\"Tarjeta de regalo\";s:17:\"Tarjeta de regalo\";s:18:\"Tarjeta de débito\";s:18:\"Tarjeta de débito\";s:19:\"Tarjeta de crédito\";s:19:\"Tarjeta de crédito\";s:18:\"Línea de crédito\";s:18:\"Línea de crédito\";s:6:\"Puntos\";s:6:\"Puntos\";s:12:\"பணம்\";s:8:\"Efectivo\";s:21:\"காசோலை\";s:6:\"Cheque\";s:31:\"பரிசு அட்டை\";s:17:\"Tarjeta de regalo\";s:37:\"டெபிட் கார்டு\";s:18:\"Tarjeta de débito\";s:28:\"கடன் அட்டை\";s:19:\"Tarjeta de crédito\";s:52:\"கணக்கு சேமிக்கவும்\";s:18:\"Línea de crédito\";s:27:\"புள்ளிகள்\";s:6:\"Puntos\";s:12:\"Tiền mặt\";s:8:\"Efectivo\";s:4:\"Séc\";s:6:\"Cheque\";s:17:\"Thẻ quà tặng\";s:17:\"Tarjeta de regalo\";s:14:\"Thẻ ghi nợ\";s:18:\"Tarjeta de débito\";s:17:\"Thẻ tín dụng\";s:19:\"Tarjeta de crédito\";s:30:\"Tài khoản của cửa hàng\";s:18:\"Línea de crédito\";s:7:\"Điểm\";s:6:\"Puntos\";}fullscreen|s:1:\"0\";keep_alive|i:1748033030;amount_change|d:-0;receiving|s:1793:\"O:14:\"PHPPOSCartRecv\":58:{s:12:\"receiving_id\";N;s:11:\"supplier_id\";N;s:20:\"transfer_location_id\";N;s:25:\"transfer_from_location_id\";N;s:5:\"is_po\";b:0;s:13:\"shipping_cost\";N;s:26:\"receiving_exchange_details\";s:0:\"\";s:19:\"\0PHPPOSCart\0cart_id\";s:9:\"receiving\";s:22:\"\0PHPPOSCart\0cart_items\";a:0:{}s:20:\"\0PHPPOSCart\0payments\";a:0:{}s:26:\"\0PHPPOSCart\0excluded_taxes\";a:0:{}s:16:\"\0PHPPOSCart\0mode\";s:7:\"receive\";s:34:\"\0PHPPOSCart\0paid_store_account_ids\";a:0:{}s:26:\"paid_store_account_amounts\";N;s:11:\"employee_id\";N;s:11:\"location_id\";N;s:11:\"register_id\";N;s:7:\"comment\";s:0:\"\";s:16:\"selected_payment\";s:0:\"\";s:13:\"email_receipt\";b:0;s:11:\"sms_receipt\";b:0;s:9:\"suspended\";i:0;s:18:\"change_date_enable\";b:0;s:16:\"change_cart_date\";N;s:19:\"is_editing_previous\";b:0;s:20:\"custom_field_1_value\";N;s:20:\"custom_field_2_value\";N;s:20:\"custom_field_3_value\";N;s:20:\"custom_field_4_value\";N;s:20:\"custom_field_5_value\";N;s:20:\"custom_field_6_value\";N;s:20:\"custom_field_7_value\";N;s:20:\"custom_field_8_value\";N;s:20:\"custom_field_9_value\";N;s:21:\"custom_field_10_value\";N;s:31:\"work_order_custom_field_1_value\";N;s:31:\"work_order_custom_field_2_value\";N;s:31:\"work_order_custom_field_3_value\";N;s:31:\"work_order_custom_field_4_value\";N;s:31:\"work_order_custom_field_5_value\";N;s:31:\"work_order_custom_field_6_value\";N;s:31:\"work_order_custom_field_7_value\";N;s:31:\"work_order_custom_field_8_value\";N;s:31:\"work_order_custom_field_9_value\";N;s:32:\"work_order_custom_field_10_value\";N;s:18:\"override_tax_names\";N;s:21:\"override_tax_percents\";N;s:24:\"override_tax_cumulatives\";N;s:18:\"override_tax_class\";N;s:17:\"details_collapsed\";b:0;s:12:\"skip_webhook\";b:0;s:6:\"offset\";i:0;s:5:\"limit\";i:20;s:11:\"sort_column\";N;s:9:\"sort_type\";N;s:14:\"create_invoice\";N;s:17:\"create_work_order\";N;s:13:\"is_work_order\";N;}\";foreign_language_to_cur_language_recv|a:81:{s:6:\"كاش\";s:8:\"Efectivo\";s:6:\"شيك\";s:6:\"Cheque\";s:15:\"كرت هدية\";s:17:\"Tarjeta de regalo\";s:23:\"بطاقة ائتمان\";s:18:\"Tarjeta de débito\";s:27:\"بطاقة الائتمان\";s:19:\"Tarjeta de crédito\";s:21:\"حساب المتجر\";s:18:\"Línea de crédito\";s:6:\"现金\";s:8:\"Efectivo\";s:6:\"检查\";s:6:\"Cheque\";s:9:\"礼物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借记卡\";s:18:\"Tarjeta de débito\";s:9:\"信用卡\";s:19:\"Tarjeta de crédito\";s:12:\"商店帐号\";s:18:\"Línea de crédito\";s:6:\"現金\";s:8:\"Efectivo\";s:6:\"檢查\";s:6:\"Cheque\";s:9:\"禮物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借記卡\";s:18:\"Tarjeta de débito\";s:12:\"商店帳號\";s:18:\"Línea de crédito\";s:7:\"Contant\";s:8:\"Efectivo\";s:6:\"Cheque\";s:6:\"Cheque\";s:9:\"Waardebon\";s:17:\"Tarjeta de regalo\";s:9:\"Bankkaart\";s:18:\"Tarjeta de débito\";s:12:\"Kredietkaart\";s:19:\"Tarjeta de crédito\";s:11:\"Op rekening\";s:18:\"Línea de crédito\";s:4:\"Cash\";s:8:\"Efectivo\";s:5:\"Check\";s:6:\"Cheque\";s:9:\"Gift Card\";s:17:\"Tarjeta de regalo\";s:10:\"Debit Card\";s:18:\"Tarjeta de débito\";s:11:\"Credit Card\";s:19:\"Tarjeta de crédito\";s:13:\"Store Account\";s:18:\"Línea de crédito\";s:8:\"Comptant\";s:8:\"Efectivo\";s:7:\"Chèque\";s:6:\"Cheque\";s:12:\"Carte cadeau\";s:17:\"Tarjeta de regalo\";s:12:\"Carte débit\";s:18:\"Tarjeta de débito\";s:12:\"Carte credit\";s:19:\"Tarjeta de crédito\";s:14:\"Compte magasin\";s:18:\"Línea de crédito\";s:7:\"Bargeld\";s:8:\"Efectivo\";s:6:\"Scheck\";s:6:\"Cheque\";s:9:\"Gutschein\";s:17:\"Tarjeta de regalo\";s:11:\"Kundenkarte\";s:18:\"Tarjeta de débito\";s:11:\"Kreditkarte\";s:19:\"Tarjeta de crédito\";s:13:\"Laden-Account\";s:18:\"Línea de crédito\";s:5:\"Tunai\";s:8:\"Efectivo\";s:3:\"Cek\";s:6:\"Cheque\";s:12:\"Hadiah Kartu\";s:17:\"Tarjeta de regalo\";s:11:\"Kartu Debit\";s:18:\"Tarjeta de débito\";s:12:\"Kartu Credit\";s:19:\"Tarjeta de crédito\";s:9:\"Toko Akun\";s:18:\"Línea de crédito\";s:8:\"Contante\";s:8:\"Efectivo\";s:7:\"Assegno\";s:6:\"Cheque\";s:12:\"Buono Regalo\";s:17:\"Tarjeta de regalo\";s:8:\"Bancomat\";s:18:\"Tarjeta de débito\";s:16:\"Carta di Credito\";s:19:\"Tarjeta de crédito\";s:14:\"Conto deposito\";s:18:\"Línea de crédito\";s:30:\"សាច់ប្រាក់\";s:8:\"Efectivo\";s:9:\"សែក\";s:6:\"Cheque\";s:33:\"កាត​រង្វាន់\";s:17:\"Tarjeta de regalo\";s:36:\"ប័ណ្ណ​ឥណពន្ធ\";s:18:\"Tarjeta de débito\";s:33:\"ប័ណ្ណ​ឥណទាន\";s:19:\"Tarjeta de crédito\";s:36:\"ប្រាក់ជំពាក់\";s:18:\"Línea de crédito\";s:10:\"Numerário\";s:8:\"Efectivo\";s:14:\"Vale de Oferta\";s:17:\"Tarjeta de regalo\";s:18:\"Cartão de Débito\";s:18:\"Tarjeta de débito\";s:19:\"Cartão de Crédito\";s:19:\"Tarjeta de crédito\";s:13:\"Conta da Loja\";s:18:\"Línea de crédito\";s:8:\"Efectivo\";s:8:\"Efectivo\";s:17:\"Tarjeta de regalo\";s:17:\"Tarjeta de regalo\";s:18:\"Tarjeta de débito\";s:18:\"Tarjeta de débito\";s:19:\"Tarjeta de crédito\";s:19:\"Tarjeta de crédito\";s:18:\"Línea de crédito\";s:18:\"Línea de crédito\";s:12:\"பணம்\";s:8:\"Efectivo\";s:21:\"காசோலை\";s:6:\"Cheque\";s:31:\"பரிசு அட்டை\";s:17:\"Tarjeta de regalo\";s:37:\"டெபிட் கார்டு\";s:18:\"Tarjeta de débito\";s:28:\"கடன் அட்டை\";s:19:\"Tarjeta de crédito\";s:52:\"கணக்கு சேமிக்கவும்\";s:18:\"Línea de crédito\";s:12:\"Tiền mặt\";s:8:\"Efectivo\";s:4:\"Séc\";s:6:\"Cheque\";s:17:\"Thẻ quà tặng\";s:17:\"Tarjeta de regalo\";s:14:\"Thẻ ghi nợ\";s:18:\"Tarjeta de débito\";s:17:\"Thẻ tín dụng\";s:19:\"Tarjeta de crédito\";s:30:\"Tài khoản của cửa hàng\";s:18:\"Línea de crédito\";}'),('hhp6rrk5ieij9rif7r57as71ajng7t1c','::1',1747861456,_binary 'person_id|s:1:\"1\";sale|s:2599:\"O:14:\"PHPPOSCartSale\":83:{s:7:\"sale_id\";N;s:14:\"return_sale_id\";N;s:11:\"ref_sale_id\";N;s:13:\"ref_sale_desc\";s:0:\"\";s:11:\"customer_id\";N;s:23:\"show_comment_on_receipt\";b:0;s:16:\"selected_tier_id\";i:0;s:16:\"previous_tier_id\";i:0;s:19:\"sold_by_employee_id\";s:1:\"1\";s:15:\"discount_reason\";s:0:\"\";s:12:\"has_delivery\";b:0;s:8:\"delivery\";O:18:\"PHPPOSCartDelivery\":3:{s:13:\"delivery_info\";N;s:21:\"delivery_tax_group_id\";N;s:20:\"delivery_person_info\";N;}s:20:\"partial_transactions\";a:0:{}s:17:\"use_cc_saved_info\";b:0;s:10:\"invoice_no\";s:0:\"\";s:15:\"prompt_for_card\";b:0;s:11:\"ebt_voucher\";s:0:\"\";s:14:\"ebt_voucher_no\";s:0:\"\";s:13:\"ebt_auth_code\";s:0:\"\";s:21:\"save_credit_card_info\";b:0;s:17:\"use_saved_cc_info\";b:0;s:15:\"redeem_discount\";b:0;s:21:\"sale_exchange_details\";s:0:\"\";s:7:\"coupons\";a:0:{}s:12:\"is_ecommerce\";b:0;s:29:\"integrated_gift_card_balances\";a:0:{}s:3:\"age\";N;s:12:\"taxjar_taxes\";a:0:{}s:22:\"was_last_edit_quantity\";b:0;s:25:\"show_terms_and_conditions\";s:0:\"\";s:24:\"customer_subscription_id\";N;s:17:\"create_work_order\";i:0;s:13:\"is_work_order\";b:0;s:13:\"return_reason\";N;s:19:\"\0PHPPOSCart\0cart_id\";s:4:\"sale\";s:22:\"\0PHPPOSCart\0cart_items\";a:0:{}s:20:\"\0PHPPOSCart\0payments\";a:0:{}s:26:\"\0PHPPOSCart\0excluded_taxes\";a:0:{}s:16:\"\0PHPPOSCart\0mode\";s:4:\"sale\";s:34:\"\0PHPPOSCart\0paid_store_account_ids\";a:0:{}s:26:\"paid_store_account_amounts\";N;s:11:\"employee_id\";N;s:11:\"location_id\";N;s:11:\"register_id\";N;s:7:\"comment\";s:0:\"\";s:16:\"selected_payment\";s:0:\"\";s:13:\"email_receipt\";b:0;s:11:\"sms_receipt\";b:0;s:9:\"suspended\";i:0;s:18:\"change_date_enable\";b:0;s:16:\"change_cart_date\";N;s:19:\"is_editing_previous\";b:0;s:20:\"custom_field_1_value\";N;s:20:\"custom_field_2_value\";N;s:20:\"custom_field_3_value\";N;s:20:\"custom_field_4_value\";N;s:20:\"custom_field_5_value\";N;s:20:\"custom_field_6_value\";N;s:20:\"custom_field_7_value\";N;s:20:\"custom_field_8_value\";N;s:20:\"custom_field_9_value\";N;s:21:\"custom_field_10_value\";N;s:31:\"work_order_custom_field_1_value\";N;s:31:\"work_order_custom_field_2_value\";N;s:31:\"work_order_custom_field_3_value\";N;s:31:\"work_order_custom_field_4_value\";N;s:31:\"work_order_custom_field_5_value\";N;s:31:\"work_order_custom_field_6_value\";N;s:31:\"work_order_custom_field_7_value\";N;s:31:\"work_order_custom_field_8_value\";N;s:31:\"work_order_custom_field_9_value\";N;s:32:\"work_order_custom_field_10_value\";N;s:18:\"override_tax_names\";N;s:21:\"override_tax_percents\";N;s:24:\"override_tax_cumulatives\";N;s:18:\"override_tax_class\";N;s:17:\"details_collapsed\";b:0;s:12:\"skip_webhook\";b:0;s:6:\"offset\";i:0;s:5:\"limit\";i:20;s:11:\"sort_column\";N;s:9:\"sort_type\";N;s:14:\"create_invoice\";N;}\";employee_current_register_id|s:1:\"1\";foreign_language_to_cur_language_sales|a:95:{s:6:\"كاش\";s:8:\"Efectivo\";s:6:\"شيك\";s:6:\"Cheque\";s:15:\"كرت هدية\";s:17:\"Tarjeta de regalo\";s:23:\"بطاقة ائتمان\";s:18:\"Tarjeta de débito\";s:27:\"بطاقة الائتمان\";s:19:\"Tarjeta de crédito\";s:21:\"حساب المتجر\";s:18:\"Línea de crédito\";s:8:\"نقاط\";s:6:\"Puntos\";s:6:\"现金\";s:8:\"Efectivo\";s:6:\"检查\";s:6:\"Cheque\";s:9:\"礼物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借记卡\";s:18:\"Tarjeta de débito\";s:9:\"信用卡\";s:19:\"Tarjeta de crédito\";s:12:\"商店帐号\";s:18:\"Línea de crédito\";s:3:\"点\";s:6:\"Puntos\";s:6:\"現金\";s:8:\"Efectivo\";s:6:\"檢查\";s:6:\"Cheque\";s:9:\"禮物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借記卡\";s:18:\"Tarjeta de débito\";s:12:\"商店帳號\";s:18:\"Línea de crédito\";s:3:\"點\";s:6:\"Puntos\";s:7:\"Contant\";s:8:\"Efectivo\";s:6:\"Cheque\";s:6:\"Cheque\";s:9:\"Waardebon\";s:17:\"Tarjeta de regalo\";s:9:\"Bankkaart\";s:18:\"Tarjeta de débito\";s:12:\"Kredietkaart\";s:19:\"Tarjeta de crédito\";s:11:\"Op rekening\";s:18:\"Línea de crédito\";s:6:\"Punten\";s:6:\"Puntos\";s:4:\"Cash\";s:8:\"Efectivo\";s:5:\"Check\";s:6:\"Cheque\";s:9:\"Gift Card\";s:17:\"Tarjeta de regalo\";s:10:\"Debit Card\";s:18:\"Tarjeta de débito\";s:11:\"Credit Card\";s:19:\"Tarjeta de crédito\";s:13:\"Store Account\";s:18:\"Línea de crédito\";s:6:\"Points\";s:6:\"Puntos\";s:8:\"Comptant\";s:8:\"Efectivo\";s:7:\"Chèque\";s:6:\"Cheque\";s:12:\"Carte cadeau\";s:17:\"Tarjeta de regalo\";s:12:\"Carte débit\";s:18:\"Tarjeta de débito\";s:12:\"Carte credit\";s:19:\"Tarjeta de crédito\";s:14:\"Compte magasin\";s:18:\"Línea de crédito\";s:10:\"Des points\";s:6:\"Puntos\";s:7:\"Bargeld\";s:8:\"Efectivo\";s:6:\"Scheck\";s:6:\"Cheque\";s:9:\"Gutschein\";s:17:\"Tarjeta de regalo\";s:11:\"Kundenkarte\";s:18:\"Tarjeta de débito\";s:11:\"Kreditkarte\";s:19:\"Tarjeta de crédito\";s:13:\"Laden-Account\";s:18:\"Línea de crédito\";s:6:\"Punkte\";s:6:\"Puntos\";s:5:\"Tunai\";s:8:\"Efectivo\";s:3:\"Cek\";s:6:\"Cheque\";s:12:\"Hadiah Kartu\";s:17:\"Tarjeta de regalo\";s:11:\"Kartu Debit\";s:18:\"Tarjeta de débito\";s:12:\"Kartu Credit\";s:19:\"Tarjeta de crédito\";s:9:\"Toko Akun\";s:18:\"Línea de crédito\";s:4:\"Poin\";s:6:\"Puntos\";s:8:\"Contante\";s:8:\"Efectivo\";s:7:\"Assegno\";s:6:\"Cheque\";s:12:\"Buono Regalo\";s:17:\"Tarjeta de regalo\";s:8:\"Bancomat\";s:18:\"Tarjeta de débito\";s:16:\"Carta di Credito\";s:19:\"Tarjeta de crédito\";s:14:\"Conto deposito\";s:18:\"Línea de crédito\";s:5:\"Punti\";s:6:\"Puntos\";s:30:\"សាច់ប្រាក់\";s:8:\"Efectivo\";s:9:\"សែក\";s:6:\"Cheque\";s:33:\"កាត​រង្វាន់\";s:17:\"Tarjeta de regalo\";s:36:\"ប័ណ្ណ​ឥណពន្ធ\";s:18:\"Tarjeta de débito\";s:33:\"ប័ណ្ណ​ឥណទាន\";s:19:\"Tarjeta de crédito\";s:36:\"ប្រាក់ជំពាក់\";s:18:\"Línea de crédito\";s:18:\"ពិន្ទុ\";s:6:\"Puntos\";s:10:\"Numerário\";s:8:\"Efectivo\";s:14:\"Vale de Oferta\";s:17:\"Tarjeta de regalo\";s:18:\"Cartão de Débito\";s:18:\"Tarjeta de débito\";s:19:\"Cartão de Crédito\";s:19:\"Tarjeta de crédito\";s:13:\"Conta da Loja\";s:18:\"Línea de crédito\";s:6:\"Pontos\";s:6:\"Puntos\";s:8:\"Efectivo\";s:8:\"Efectivo\";s:17:\"Tarjeta de regalo\";s:17:\"Tarjeta de regalo\";s:18:\"Tarjeta de débito\";s:18:\"Tarjeta de débito\";s:19:\"Tarjeta de crédito\";s:19:\"Tarjeta de crédito\";s:18:\"Línea de crédito\";s:18:\"Línea de crédito\";s:6:\"Puntos\";s:6:\"Puntos\";s:12:\"பணம்\";s:8:\"Efectivo\";s:21:\"காசோலை\";s:6:\"Cheque\";s:31:\"பரிசு அட்டை\";s:17:\"Tarjeta de regalo\";s:37:\"டெபிட் கார்டு\";s:18:\"Tarjeta de débito\";s:28:\"கடன் அட்டை\";s:19:\"Tarjeta de crédito\";s:52:\"கணக்கு சேமிக்கவும்\";s:18:\"Línea de crédito\";s:27:\"புள்ளிகள்\";s:6:\"Puntos\";s:12:\"Tiền mặt\";s:8:\"Efectivo\";s:4:\"Séc\";s:6:\"Cheque\";s:17:\"Thẻ quà tặng\";s:17:\"Tarjeta de regalo\";s:14:\"Thẻ ghi nợ\";s:18:\"Tarjeta de débito\";s:17:\"Thẻ tín dụng\";s:19:\"Tarjeta de crédito\";s:30:\"Tài khoản của cửa hàng\";s:18:\"Línea de crédito\";s:7:\"Điểm\";s:6:\"Puntos\";}fullscreen|s:1:\"0\";keep_alive|i:1747861456;'),('j3te07iup62vnmkkt7sj8qenffispa7f','::1',1747948220,''),('oj8uma8rijce91smsi9aejb8rnedvnvj','::1',1747948167,_binary 'person_id|s:1:\"1\";sale|s:2597:\"O:14:\"PHPPOSCartSale\":83:{s:7:\"sale_id\";N;s:14:\"return_sale_id\";N;s:11:\"ref_sale_id\";N;s:13:\"ref_sale_desc\";s:0:\"\";s:11:\"customer_id\";N;s:23:\"show_comment_on_receipt\";b:0;s:16:\"selected_tier_id\";i:0;s:16:\"previous_tier_id\";i:0;s:19:\"sold_by_employee_id\";N;s:15:\"discount_reason\";s:0:\"\";s:12:\"has_delivery\";b:0;s:8:\"delivery\";O:18:\"PHPPOSCartDelivery\":3:{s:13:\"delivery_info\";N;s:21:\"delivery_tax_group_id\";N;s:20:\"delivery_person_info\";N;}s:20:\"partial_transactions\";a:0:{}s:17:\"use_cc_saved_info\";b:0;s:10:\"invoice_no\";s:0:\"\";s:15:\"prompt_for_card\";b:0;s:11:\"ebt_voucher\";s:0:\"\";s:14:\"ebt_voucher_no\";s:0:\"\";s:13:\"ebt_auth_code\";s:0:\"\";s:21:\"save_credit_card_info\";b:0;s:17:\"use_saved_cc_info\";b:0;s:15:\"redeem_discount\";b:0;s:21:\"sale_exchange_details\";s:0:\"\";s:7:\"coupons\";a:0:{}s:12:\"is_ecommerce\";b:0;s:29:\"integrated_gift_card_balances\";a:0:{}s:3:\"age\";N;s:12:\"taxjar_taxes\";a:0:{}s:22:\"was_last_edit_quantity\";b:0;s:25:\"show_terms_and_conditions\";s:0:\"\";s:24:\"customer_subscription_id\";N;s:17:\"create_work_order\";i:0;s:13:\"is_work_order\";b:0;s:13:\"return_reason\";N;s:19:\"\0PHPPOSCart\0cart_id\";s:4:\"sale\";s:22:\"\0PHPPOSCart\0cart_items\";a:0:{}s:20:\"\0PHPPOSCart\0payments\";a:0:{}s:26:\"\0PHPPOSCart\0excluded_taxes\";a:0:{}s:16:\"\0PHPPOSCart\0mode\";s:4:\"sale\";s:34:\"\0PHPPOSCart\0paid_store_account_ids\";a:0:{}s:26:\"paid_store_account_amounts\";a:0:{}s:11:\"employee_id\";N;s:11:\"location_id\";N;s:11:\"register_id\";N;s:7:\"comment\";s:0:\"\";s:16:\"selected_payment\";s:0:\"\";s:13:\"email_receipt\";b:0;s:11:\"sms_receipt\";b:0;s:9:\"suspended\";i:0;s:18:\"change_date_enable\";b:0;s:16:\"change_cart_date\";N;s:19:\"is_editing_previous\";b:0;s:20:\"custom_field_1_value\";N;s:20:\"custom_field_2_value\";N;s:20:\"custom_field_3_value\";N;s:20:\"custom_field_4_value\";N;s:20:\"custom_field_5_value\";N;s:20:\"custom_field_6_value\";N;s:20:\"custom_field_7_value\";N;s:20:\"custom_field_8_value\";N;s:20:\"custom_field_9_value\";N;s:21:\"custom_field_10_value\";N;s:31:\"work_order_custom_field_1_value\";N;s:31:\"work_order_custom_field_2_value\";N;s:31:\"work_order_custom_field_3_value\";N;s:31:\"work_order_custom_field_4_value\";N;s:31:\"work_order_custom_field_5_value\";N;s:31:\"work_order_custom_field_6_value\";N;s:31:\"work_order_custom_field_7_value\";N;s:31:\"work_order_custom_field_8_value\";N;s:31:\"work_order_custom_field_9_value\";N;s:32:\"work_order_custom_field_10_value\";N;s:18:\"override_tax_names\";N;s:21:\"override_tax_percents\";N;s:24:\"override_tax_cumulatives\";N;s:18:\"override_tax_class\";N;s:17:\"details_collapsed\";b:0;s:12:\"skip_webhook\";b:0;s:6:\"offset\";i:0;s:5:\"limit\";i:20;s:11:\"sort_column\";N;s:9:\"sort_type\";N;s:14:\"create_invoice\";N;}\";employee_current_register_id|s:1:\"1\";foreign_language_to_cur_language_sales|a:95:{s:6:\"كاش\";s:8:\"Efectivo\";s:6:\"شيك\";s:6:\"Cheque\";s:15:\"كرت هدية\";s:17:\"Tarjeta de regalo\";s:23:\"بطاقة ائتمان\";s:18:\"Tarjeta de débito\";s:27:\"بطاقة الائتمان\";s:19:\"Tarjeta de crédito\";s:21:\"حساب المتجر\";s:18:\"Línea de crédito\";s:8:\"نقاط\";s:6:\"Puntos\";s:6:\"现金\";s:8:\"Efectivo\";s:6:\"检查\";s:6:\"Cheque\";s:9:\"礼物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借记卡\";s:18:\"Tarjeta de débito\";s:9:\"信用卡\";s:19:\"Tarjeta de crédito\";s:12:\"商店帐号\";s:18:\"Línea de crédito\";s:3:\"点\";s:6:\"Puntos\";s:6:\"現金\";s:8:\"Efectivo\";s:6:\"檢查\";s:6:\"Cheque\";s:9:\"禮物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借記卡\";s:18:\"Tarjeta de débito\";s:12:\"商店帳號\";s:18:\"Línea de crédito\";s:3:\"點\";s:6:\"Puntos\";s:7:\"Contant\";s:8:\"Efectivo\";s:6:\"Cheque\";s:6:\"Cheque\";s:9:\"Waardebon\";s:17:\"Tarjeta de regalo\";s:9:\"Bankkaart\";s:18:\"Tarjeta de débito\";s:12:\"Kredietkaart\";s:19:\"Tarjeta de crédito\";s:11:\"Op rekening\";s:18:\"Línea de crédito\";s:6:\"Punten\";s:6:\"Puntos\";s:4:\"Cash\";s:8:\"Efectivo\";s:5:\"Check\";s:6:\"Cheque\";s:9:\"Gift Card\";s:17:\"Tarjeta de regalo\";s:10:\"Debit Card\";s:18:\"Tarjeta de débito\";s:11:\"Credit Card\";s:19:\"Tarjeta de crédito\";s:13:\"Store Account\";s:18:\"Línea de crédito\";s:6:\"Points\";s:6:\"Puntos\";s:8:\"Comptant\";s:8:\"Efectivo\";s:7:\"Chèque\";s:6:\"Cheque\";s:12:\"Carte cadeau\";s:17:\"Tarjeta de regalo\";s:12:\"Carte débit\";s:18:\"Tarjeta de débito\";s:12:\"Carte credit\";s:19:\"Tarjeta de crédito\";s:14:\"Compte magasin\";s:18:\"Línea de crédito\";s:10:\"Des points\";s:6:\"Puntos\";s:7:\"Bargeld\";s:8:\"Efectivo\";s:6:\"Scheck\";s:6:\"Cheque\";s:9:\"Gutschein\";s:17:\"Tarjeta de regalo\";s:11:\"Kundenkarte\";s:18:\"Tarjeta de débito\";s:11:\"Kreditkarte\";s:19:\"Tarjeta de crédito\";s:13:\"Laden-Account\";s:18:\"Línea de crédito\";s:6:\"Punkte\";s:6:\"Puntos\";s:5:\"Tunai\";s:8:\"Efectivo\";s:3:\"Cek\";s:6:\"Cheque\";s:12:\"Hadiah Kartu\";s:17:\"Tarjeta de regalo\";s:11:\"Kartu Debit\";s:18:\"Tarjeta de débito\";s:12:\"Kartu Credit\";s:19:\"Tarjeta de crédito\";s:9:\"Toko Akun\";s:18:\"Línea de crédito\";s:4:\"Poin\";s:6:\"Puntos\";s:8:\"Contante\";s:8:\"Efectivo\";s:7:\"Assegno\";s:6:\"Cheque\";s:12:\"Buono Regalo\";s:17:\"Tarjeta de regalo\";s:8:\"Bancomat\";s:18:\"Tarjeta de débito\";s:16:\"Carta di Credito\";s:19:\"Tarjeta de crédito\";s:14:\"Conto deposito\";s:18:\"Línea de crédito\";s:5:\"Punti\";s:6:\"Puntos\";s:30:\"សាច់ប្រាក់\";s:8:\"Efectivo\";s:9:\"សែក\";s:6:\"Cheque\";s:33:\"កាត​រង្វាន់\";s:17:\"Tarjeta de regalo\";s:36:\"ប័ណ្ណ​ឥណពន្ធ\";s:18:\"Tarjeta de débito\";s:33:\"ប័ណ្ណ​ឥណទាន\";s:19:\"Tarjeta de crédito\";s:36:\"ប្រាក់ជំពាក់\";s:18:\"Línea de crédito\";s:18:\"ពិន្ទុ\";s:6:\"Puntos\";s:10:\"Numerário\";s:8:\"Efectivo\";s:14:\"Vale de Oferta\";s:17:\"Tarjeta de regalo\";s:18:\"Cartão de Débito\";s:18:\"Tarjeta de débito\";s:19:\"Cartão de Crédito\";s:19:\"Tarjeta de crédito\";s:13:\"Conta da Loja\";s:18:\"Línea de crédito\";s:6:\"Pontos\";s:6:\"Puntos\";s:8:\"Efectivo\";s:8:\"Efectivo\";s:17:\"Tarjeta de regalo\";s:17:\"Tarjeta de regalo\";s:18:\"Tarjeta de débito\";s:18:\"Tarjeta de débito\";s:19:\"Tarjeta de crédito\";s:19:\"Tarjeta de crédito\";s:18:\"Línea de crédito\";s:18:\"Línea de crédito\";s:6:\"Puntos\";s:6:\"Puntos\";s:12:\"பணம்\";s:8:\"Efectivo\";s:21:\"காசோலை\";s:6:\"Cheque\";s:31:\"பரிசு அட்டை\";s:17:\"Tarjeta de regalo\";s:37:\"டெபிட் கார்டு\";s:18:\"Tarjeta de débito\";s:28:\"கடன் அட்டை\";s:19:\"Tarjeta de crédito\";s:52:\"கணக்கு சேமிக்கவும்\";s:18:\"Línea de crédito\";s:27:\"புள்ளிகள்\";s:6:\"Puntos\";s:12:\"Tiền mặt\";s:8:\"Efectivo\";s:4:\"Séc\";s:6:\"Cheque\";s:17:\"Thẻ quà tặng\";s:17:\"Tarjeta de regalo\";s:14:\"Thẻ ghi nợ\";s:18:\"Tarjeta de débito\";s:17:\"Thẻ tín dụng\";s:19:\"Tarjeta de crédito\";s:30:\"Tài khoản của cửa hàng\";s:18:\"Línea de crédito\";s:7:\"Điểm\";s:6:\"Puntos\";}fullscreen|s:1:\"0\";keep_alive|i:1747948167;amount_change|d:-0;receiving|s:1793:\"O:14:\"PHPPOSCartRecv\":58:{s:12:\"receiving_id\";N;s:11:\"supplier_id\";N;s:20:\"transfer_location_id\";N;s:25:\"transfer_from_location_id\";N;s:5:\"is_po\";b:0;s:13:\"shipping_cost\";N;s:26:\"receiving_exchange_details\";s:0:\"\";s:19:\"\0PHPPOSCart\0cart_id\";s:9:\"receiving\";s:22:\"\0PHPPOSCart\0cart_items\";a:0:{}s:20:\"\0PHPPOSCart\0payments\";a:0:{}s:26:\"\0PHPPOSCart\0excluded_taxes\";a:0:{}s:16:\"\0PHPPOSCart\0mode\";s:7:\"receive\";s:34:\"\0PHPPOSCart\0paid_store_account_ids\";a:0:{}s:26:\"paid_store_account_amounts\";N;s:11:\"employee_id\";N;s:11:\"location_id\";N;s:11:\"register_id\";N;s:7:\"comment\";s:0:\"\";s:16:\"selected_payment\";s:0:\"\";s:13:\"email_receipt\";b:0;s:11:\"sms_receipt\";b:0;s:9:\"suspended\";i:0;s:18:\"change_date_enable\";b:0;s:16:\"change_cart_date\";N;s:19:\"is_editing_previous\";b:0;s:20:\"custom_field_1_value\";N;s:20:\"custom_field_2_value\";N;s:20:\"custom_field_3_value\";N;s:20:\"custom_field_4_value\";N;s:20:\"custom_field_5_value\";N;s:20:\"custom_field_6_value\";N;s:20:\"custom_field_7_value\";N;s:20:\"custom_field_8_value\";N;s:20:\"custom_field_9_value\";N;s:21:\"custom_field_10_value\";N;s:31:\"work_order_custom_field_1_value\";N;s:31:\"work_order_custom_field_2_value\";N;s:31:\"work_order_custom_field_3_value\";N;s:31:\"work_order_custom_field_4_value\";N;s:31:\"work_order_custom_field_5_value\";N;s:31:\"work_order_custom_field_6_value\";N;s:31:\"work_order_custom_field_7_value\";N;s:31:\"work_order_custom_field_8_value\";N;s:31:\"work_order_custom_field_9_value\";N;s:32:\"work_order_custom_field_10_value\";N;s:18:\"override_tax_names\";N;s:21:\"override_tax_percents\";N;s:24:\"override_tax_cumulatives\";N;s:18:\"override_tax_class\";N;s:17:\"details_collapsed\";b:0;s:12:\"skip_webhook\";b:0;s:6:\"offset\";i:0;s:5:\"limit\";i:20;s:11:\"sort_column\";N;s:9:\"sort_type\";N;s:14:\"create_invoice\";N;s:17:\"create_work_order\";N;s:13:\"is_work_order\";N;}\";foreign_language_to_cur_language_recv|a:81:{s:6:\"كاش\";s:8:\"Efectivo\";s:6:\"شيك\";s:6:\"Cheque\";s:15:\"كرت هدية\";s:17:\"Tarjeta de regalo\";s:23:\"بطاقة ائتمان\";s:18:\"Tarjeta de débito\";s:27:\"بطاقة الائتمان\";s:19:\"Tarjeta de crédito\";s:21:\"حساب المتجر\";s:18:\"Línea de crédito\";s:6:\"现金\";s:8:\"Efectivo\";s:6:\"检查\";s:6:\"Cheque\";s:9:\"礼物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借记卡\";s:18:\"Tarjeta de débito\";s:9:\"信用卡\";s:19:\"Tarjeta de crédito\";s:12:\"商店帐号\";s:18:\"Línea de crédito\";s:6:\"現金\";s:8:\"Efectivo\";s:6:\"檢查\";s:6:\"Cheque\";s:9:\"禮物卡\";s:17:\"Tarjeta de regalo\";s:9:\"借記卡\";s:18:\"Tarjeta de débito\";s:12:\"商店帳號\";s:18:\"Línea de crédito\";s:7:\"Contant\";s:8:\"Efectivo\";s:6:\"Cheque\";s:6:\"Cheque\";s:9:\"Waardebon\";s:17:\"Tarjeta de regalo\";s:9:\"Bankkaart\";s:18:\"Tarjeta de débito\";s:12:\"Kredietkaart\";s:19:\"Tarjeta de crédito\";s:11:\"Op rekening\";s:18:\"Línea de crédito\";s:4:\"Cash\";s:8:\"Efectivo\";s:5:\"Check\";s:6:\"Cheque\";s:9:\"Gift Card\";s:17:\"Tarjeta de regalo\";s:10:\"Debit Card\";s:18:\"Tarjeta de débito\";s:11:\"Credit Card\";s:19:\"Tarjeta de crédito\";s:13:\"Store Account\";s:18:\"Línea de crédito\";s:8:\"Comptant\";s:8:\"Efectivo\";s:7:\"Chèque\";s:6:\"Cheque\";s:12:\"Carte cadeau\";s:17:\"Tarjeta de regalo\";s:12:\"Carte débit\";s:18:\"Tarjeta de débito\";s:12:\"Carte credit\";s:19:\"Tarjeta de crédito\";s:14:\"Compte magasin\";s:18:\"Línea de crédito\";s:7:\"Bargeld\";s:8:\"Efectivo\";s:6:\"Scheck\";s:6:\"Cheque\";s:9:\"Gutschein\";s:17:\"Tarjeta de regalo\";s:11:\"Kundenkarte\";s:18:\"Tarjeta de débito\";s:11:\"Kreditkarte\";s:19:\"Tarjeta de crédito\";s:13:\"Laden-Account\";s:18:\"Línea de crédito\";s:5:\"Tunai\";s:8:\"Efectivo\";s:3:\"Cek\";s:6:\"Cheque\";s:12:\"Hadiah Kartu\";s:17:\"Tarjeta de regalo\";s:11:\"Kartu Debit\";s:18:\"Tarjeta de débito\";s:12:\"Kartu Credit\";s:19:\"Tarjeta de crédito\";s:9:\"Toko Akun\";s:18:\"Línea de crédito\";s:8:\"Contante\";s:8:\"Efectivo\";s:7:\"Assegno\";s:6:\"Cheque\";s:12:\"Buono Regalo\";s:17:\"Tarjeta de regalo\";s:8:\"Bancomat\";s:18:\"Tarjeta de débito\";s:16:\"Carta di Credito\";s:19:\"Tarjeta de crédito\";s:14:\"Conto deposito\";s:18:\"Línea de crédito\";s:30:\"សាច់ប្រាក់\";s:8:\"Efectivo\";s:9:\"សែក\";s:6:\"Cheque\";s:33:\"កាត​រង្វាន់\";s:17:\"Tarjeta de regalo\";s:36:\"ប័ណ្ណ​ឥណពន្ធ\";s:18:\"Tarjeta de débito\";s:33:\"ប័ណ្ណ​ឥណទាន\";s:19:\"Tarjeta de crédito\";s:36:\"ប្រាក់ជំពាក់\";s:18:\"Línea de crédito\";s:10:\"Numerário\";s:8:\"Efectivo\";s:14:\"Vale de Oferta\";s:17:\"Tarjeta de regalo\";s:18:\"Cartão de Débito\";s:18:\"Tarjeta de débito\";s:19:\"Cartão de Crédito\";s:19:\"Tarjeta de crédito\";s:13:\"Conta da Loja\";s:18:\"Línea de crédito\";s:8:\"Efectivo\";s:8:\"Efectivo\";s:17:\"Tarjeta de regalo\";s:17:\"Tarjeta de regalo\";s:18:\"Tarjeta de débito\";s:18:\"Tarjeta de débito\";s:19:\"Tarjeta de crédito\";s:19:\"Tarjeta de crédito\";s:18:\"Línea de crédito\";s:18:\"Línea de crédito\";s:12:\"பணம்\";s:8:\"Efectivo\";s:21:\"காசோலை\";s:6:\"Cheque\";s:31:\"பரிசு அட்டை\";s:17:\"Tarjeta de regalo\";s:37:\"டெபிட் கார்டு\";s:18:\"Tarjeta de débito\";s:28:\"கடன் அட்டை\";s:19:\"Tarjeta de crédito\";s:52:\"கணக்கு சேமிக்கவும்\";s:18:\"Línea de crédito\";s:12:\"Tiền mặt\";s:8:\"Efectivo\";s:4:\"Séc\";s:6:\"Cheque\";s:17:\"Thẻ quà tặng\";s:17:\"Tarjeta de regalo\";s:14:\"Thẻ ghi nợ\";s:18:\"Tarjeta de débito\";s:17:\"Thẻ tín dụng\";s:19:\"Tarjeta de crédito\";s:30:\"Tài khoản của cửa hàng\";s:18:\"Línea de crédito\";}'),('tajf9cjhnifumcibtsbqgme8lvu6094r','::1',1747918659,_binary 'person_id|s:1:\"1\";'),('vj6020td54i7vbqc28cqtpibt00qkdgb','::1',1748003736,_binary 'person_id|s:1:\"1\";');
/*!40000 ALTER TABLE `phppos_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_shipping_methods`
--

DROP TABLE IF EXISTS `phppos_shipping_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_shipping_methods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `shipping_provider_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fee` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `fee_tax_class_id` int(10) DEFAULT NULL,
  `time_in_days` int(11) DEFAULT NULL,
  `has_tracking_number` int(1) NOT NULL DEFAULT 0,
  `is_default` int(1) NOT NULL DEFAULT 0,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `phppos_shipping_methods_ibfk_1` (`shipping_provider_id`),
  KEY `phppos_shipping_methods_ibfk_2` (`fee_tax_class_id`),
  CONSTRAINT `phppos_shipping_methods_ibfk_1` FOREIGN KEY (`shipping_provider_id`) REFERENCES `phppos_shipping_providers` (`id`),
  CONSTRAINT `phppos_shipping_methods_ibfk_2` FOREIGN KEY (`fee_tax_class_id`) REFERENCES `phppos_tax_classes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_shipping_methods`
--

LOCK TABLES `phppos_shipping_methods` WRITE;
/*!40000 ALTER TABLE `phppos_shipping_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_shipping_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_shipping_providers`
--

DROP TABLE IF EXISTS `phppos_shipping_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_shipping_providers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(10) NOT NULL DEFAULT 0,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_shipping_providers`
--

LOCK TABLES `phppos_shipping_providers` WRITE;
/*!40000 ALTER TABLE `phppos_shipping_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_shipping_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_shipping_zones`
--

DROP TABLE IF EXISTS `phppos_shipping_zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_shipping_zones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `fee` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `tax_class_id` int(10) DEFAULT NULL,
  `order` int(10) NOT NULL DEFAULT 0,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `phppos_shipping_zones_ibfk_1` (`tax_class_id`),
  CONSTRAINT `phppos_shipping_zones_ibfk_1` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_shipping_zones`
--

LOCK TABLES `phppos_shipping_zones` WRITE;
/*!40000 ALTER TABLE `phppos_shipping_zones` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_shipping_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_store_accounts`
--

DROP TABLE IF EXISTS `phppos_store_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_store_accounts` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `transaction_amount` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `balance` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `comment` text NOT NULL,
  PRIMARY KEY (`sno`),
  KEY `phppos_store_accounts_ibfk_1` (`sale_id`),
  KEY `phppos_store_accounts_ibfk_2` (`customer_id`),
  CONSTRAINT `phppos_store_accounts_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_store_accounts_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `phppos_customers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_store_accounts`
--

LOCK TABLES `phppos_store_accounts` WRITE;
/*!40000 ALTER TABLE `phppos_store_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_store_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_store_accounts_paid_sales`
--

DROP TABLE IF EXISTS `phppos_store_accounts_paid_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_store_accounts_paid_sales` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `store_account_payment_sale_id` int(10) DEFAULT NULL,
  `sale_id` int(10) DEFAULT NULL,
  `partial_payment_amount` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  PRIMARY KEY (`id`),
  KEY `phppos_store_accounts_sales_ibfk_1` (`sale_id`),
  KEY `phppos_store_accounts_sales_ibfk_2` (`store_account_payment_sale_id`),
  CONSTRAINT `phppos_store_accounts_sales_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `phppos_sales` (`sale_id`),
  CONSTRAINT `phppos_store_accounts_sales_ibfk_2` FOREIGN KEY (`store_account_payment_sale_id`) REFERENCES `phppos_sales` (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_store_accounts_paid_sales`
--

LOCK TABLES `phppos_store_accounts_paid_sales` WRITE;
/*!40000 ALTER TABLE `phppos_store_accounts_paid_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_store_accounts_paid_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_sucursales_siat`
--

DROP TABLE IF EXISTS `phppos_sucursales_siat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_sucursales_siat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_sucursal` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `celular` varchar(30) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 1,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_sucursales_siat`
--

LOCK TABLES `phppos_sucursales_siat` WRITE;
/*!40000 ALTER TABLE `phppos_sucursales_siat` DISABLE KEYS */;
INSERT INTO `phppos_sucursales_siat` VALUES (1,0,'CASA MATRIZ','Calle 25 de mayo Nro 90','Elias Flores Villegas','77135854','60319667',1,'2025-05-20 12:17:36');
/*!40000 ALTER TABLE `phppos_sucursales_siat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_supplier_invoice_details`
--

DROP TABLE IF EXISTS `phppos_supplier_invoice_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_supplier_invoice_details` (
  `invoice_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `line_id` int(11) DEFAULT NULL,
  `receiving_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `total` decimal(23,10) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`invoice_details_id`) USING BTREE,
  KEY `phppos_supplier_invoice_details_ibfk_1` (`receiving_id`),
  KEY `phppos_supplier_invoice_details_ibfk_2` (`invoice_id`),
  CONSTRAINT `phppos_supplier_invoice_details_ibfk_1` FOREIGN KEY (`receiving_id`) REFERENCES `phppos_receivings` (`receiving_id`),
  CONSTRAINT `phppos_supplier_invoice_details_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `phppos_supplier_invoices` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_supplier_invoice_details`
--

LOCK TABLES `phppos_supplier_invoice_details` WRITE;
/*!40000 ALTER TABLE `phppos_supplier_invoice_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_supplier_invoice_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_supplier_invoice_payments`
--

DROP TABLE IF EXISTS `phppos_supplier_invoice_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_supplier_invoice_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_type` varchar(255) NOT NULL,
  `payment_amount` decimal(23,10) NOT NULL,
  `auth_code` varchar(255) DEFAULT '',
  `ref_no` varchar(255) DEFAULT '',
  `cc_token` varchar(255) DEFAULT '',
  `acq_ref_data` varchar(255) DEFAULT '',
  `process_data` varchar(255) DEFAULT '',
  `entry_method` varchar(255) DEFAULT '',
  `aid` varchar(255) DEFAULT '',
  `tvr` varchar(255) DEFAULT '',
  `iad` varchar(255) DEFAULT '',
  `tsi` varchar(255) DEFAULT '',
  `arc` varchar(255) DEFAULT '',
  `cvm` varchar(255) DEFAULT '',
  `tran_type` varchar(255) DEFAULT '',
  `application_label` varchar(255) DEFAULT '',
  `truncated_card` varchar(255) DEFAULT '',
  `card_issuer` varchar(255) DEFAULT '',
  PRIMARY KEY (`payment_id`) USING BTREE,
  KEY `phppos_supplier_invoice_payments_ibfk_1` (`invoice_id`),
  CONSTRAINT `phppos_supplier_invoice_payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `phppos_supplier_invoices` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_supplier_invoice_payments`
--

LOCK TABLES `phppos_supplier_invoice_payments` WRITE;
/*!40000 ALTER TABLE `phppos_supplier_invoice_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_supplier_invoice_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_supplier_invoices`
--

DROP TABLE IF EXISTS `phppos_supplier_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_supplier_invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `supplier_po` varchar(255) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `total` decimal(23,10) DEFAULT NULL,
  `balance` decimal(23,10) DEFAULT NULL,
  `last_paid` date DEFAULT NULL,
  `deleted` int(1) DEFAULT 0,
  PRIMARY KEY (`invoice_id`) USING BTREE,
  KEY `phppos_supplier_invoices_ibfk_1` (`term_id`),
  KEY `phppos_supplier_invoices_ibfk_2` (`supplier_id`),
  KEY `phppos_supplier_invoices_ibfk_3` (`location_id`),
  CONSTRAINT `phppos_supplier_invoices_ibfk_1` FOREIGN KEY (`term_id`) REFERENCES `phppos_terms` (`term_id`),
  CONSTRAINT `phppos_supplier_invoices_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`),
  CONSTRAINT `phppos_supplier_invoices_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_supplier_invoices`
--

LOCK TABLES `phppos_supplier_invoices` WRITE;
/*!40000 ALTER TABLE `phppos_supplier_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_supplier_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_supplier_store_accounts`
--

DROP TABLE IF EXISTS `phppos_supplier_store_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_supplier_store_accounts` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `receiving_id` int(11) DEFAULT NULL,
  `transaction_amount` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `balance` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `comment` text NOT NULL,
  PRIMARY KEY (`sno`),
  KEY `phppos_supplier_store_accounts_ibfk_1` (`receiving_id`),
  KEY `phppos_supplier_store_accounts_ibfk_2` (`supplier_id`),
  CONSTRAINT `phppos_supplier_store_accounts_ibfk_1` FOREIGN KEY (`receiving_id`) REFERENCES `phppos_receivings` (`receiving_id`),
  CONSTRAINT `phppos_supplier_store_accounts_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_supplier_store_accounts`
--

LOCK TABLES `phppos_supplier_store_accounts` WRITE;
/*!40000 ALTER TABLE `phppos_supplier_store_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_supplier_store_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_supplier_store_accounts_paid_receivings`
--

DROP TABLE IF EXISTS `phppos_supplier_store_accounts_paid_receivings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_supplier_store_accounts_paid_receivings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `store_account_payment_receiving_id` int(10) DEFAULT NULL,
  `receiving_id` int(10) DEFAULT NULL,
  `partial_payment_amount` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  PRIMARY KEY (`id`),
  KEY `phppos_supplier_store_accounts_paid_receivings_ibfk_1` (`receiving_id`),
  KEY `phppos_supplier_store_accounts_paid_receivings_ibfk_2` (`store_account_payment_receiving_id`),
  CONSTRAINT `phppos_supplier_store_accounts_paid_receivings_ibfk_1` FOREIGN KEY (`receiving_id`) REFERENCES `phppos_receivings` (`receiving_id`),
  CONSTRAINT `phppos_supplier_store_accounts_paid_receivings_ibfk_2` FOREIGN KEY (`store_account_payment_receiving_id`) REFERENCES `phppos_receivings` (`receiving_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_supplier_store_accounts_paid_receivings`
--

LOCK TABLES `phppos_supplier_store_accounts_paid_receivings` WRITE;
/*!40000 ALTER TABLE `phppos_supplier_store_accounts_paid_receivings` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_supplier_store_accounts_paid_receivings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_suppliers`
--

DROP TABLE IF EXISTS `phppos_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_suppliers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `override_default_tax` int(1) NOT NULL DEFAULT 0,
  `balance` decimal(23,10) NOT NULL DEFAULT 0.0000000000,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `tax_class_id` int(10) DEFAULT NULL,
  `custom_field_1_value` varchar(255) DEFAULT NULL,
  `custom_field_2_value` varchar(255) DEFAULT NULL,
  `custom_field_3_value` varchar(255) DEFAULT NULL,
  `custom_field_4_value` varchar(255) DEFAULT NULL,
  `custom_field_5_value` varchar(255) DEFAULT NULL,
  `custom_field_6_value` varchar(255) DEFAULT NULL,
  `custom_field_7_value` varchar(255) DEFAULT NULL,
  `custom_field_8_value` varchar(255) DEFAULT NULL,
  `custom_field_9_value` varchar(255) DEFAULT NULL,
  `custom_field_10_value` varchar(255) DEFAULT NULL,
  `internal_notes` text DEFAULT NULL,
  `default_term_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_number` (`account_number`),
  KEY `person_id` (`person_id`),
  KEY `deleted` (`deleted`),
  KEY `phppos_suppliers_ibfk_2` (`tax_class_id`),
  KEY `custom_field_1_value` (`custom_field_1_value`),
  KEY `custom_field_2_value` (`custom_field_2_value`),
  KEY `custom_field_3_value` (`custom_field_3_value`),
  KEY `custom_field_4_value` (`custom_field_4_value`),
  KEY `custom_field_5_value` (`custom_field_5_value`),
  KEY `custom_field_6_value` (`custom_field_6_value`),
  KEY `custom_field_7_value` (`custom_field_7_value`),
  KEY `custom_field_8_value` (`custom_field_8_value`),
  KEY `custom_field_9_value` (`custom_field_9_value`),
  KEY `custom_field_10_value` (`custom_field_10_value`),
  CONSTRAINT `phppos_suppliers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `phppos_people` (`person_id`),
  CONSTRAINT `phppos_suppliers_ibfk_2` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_suppliers`
--

LOCK TABLES `phppos_suppliers` WRITE;
/*!40000 ALTER TABLE `phppos_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_suppliers_taxes`
--

DROP TABLE IF EXISTS `phppos_suppliers_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_suppliers_taxes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tax` (`supplier_id`,`name`,`percent`),
  CONSTRAINT `phppos_suppliers_taxes_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `phppos_suppliers` (`person_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_suppliers_taxes`
--

LOCK TABLES `phppos_suppliers_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_suppliers_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_suppliers_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_tags`
--

DROP TABLE IF EXISTS `phppos_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ecommerce_tag_id` varchar(255) DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(1) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`name`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_tags`
--

LOCK TABLES `phppos_tags` WRITE;
/*!40000 ALTER TABLE `phppos_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_tax_classes`
--

DROP TABLE IF EXISTS `phppos_tax_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_tax_classes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order` int(10) NOT NULL DEFAULT 0,
  `location_id` int(10) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `ecommerce_tax_class_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_tax_classes_ibfk_1` (`location_id`),
  CONSTRAINT `phppos_tax_classes_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `phppos_locations` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_tax_classes`
--

LOCK TABLES `phppos_tax_classes` WRITE;
/*!40000 ALTER TABLE `phppos_tax_classes` DISABLE KEYS */;
INSERT INTO `phppos_tax_classes` VALUES (1,1,NULL,0,'Taxes',NULL);
/*!40000 ALTER TABLE `phppos_tax_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_tax_classes_taxes`
--

DROP TABLE IF EXISTS `phppos_tax_classes_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_tax_classes_taxes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order` int(10) NOT NULL DEFAULT 0,
  `tax_class_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  `cumulative` int(1) NOT NULL DEFAULT 0,
  `ecommerce_tax_class_tax_rate_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tax` (`tax_class_id`,`name`,`percent`),
  CONSTRAINT `phppos_tax_classes_taxes_ibfk_1` FOREIGN KEY (`tax_class_id`) REFERENCES `phppos_tax_classes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_tax_classes_taxes`
--

LOCK TABLES `phppos_tax_classes_taxes` WRITE;
/*!40000 ALTER TABLE `phppos_tax_classes_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_tax_classes_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_terms`
--

DROP TABLE IF EXISTS `phppos_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_terms` (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `days_due` int(11) DEFAULT 30,
  `deleted` int(1) DEFAULT 0,
  PRIMARY KEY (`term_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_terms`
--

LOCK TABLES `phppos_terms` WRITE;
/*!40000 ALTER TABLE `phppos_terms` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_work_order_files`
--

DROP TABLE IF EXISTS `phppos_work_order_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_work_order_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `work_order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `work_order_id` (`work_order_id`),
  KEY `file_id_2` (`file_id`),
  KEY `work_order_id_2` (`work_order_id`),
  CONSTRAINT `phppos_work_order_files_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `phppos_app_files` (`file_id`),
  CONSTRAINT `phppos_work_order_files_ibfk_2` FOREIGN KEY (`work_order_id`) REFERENCES `phppos_sales_work_orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_work_order_files`
--

LOCK TABLES `phppos_work_order_files` WRITE;
/*!40000 ALTER TABLE `phppos_work_order_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_work_order_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_work_order_log`
--

DROP TABLE IF EXISTS `phppos_work_order_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_work_order_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `work_order_id` int(10) NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(10) NOT NULL,
  `activity_text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phppos_work_order_log_ibfk_1` (`work_order_id`),
  KEY `phppos_work_order_log_ibfk_2` (`employee_id`),
  CONSTRAINT `phppos_work_order_log_ibfk_1` FOREIGN KEY (`work_order_id`) REFERENCES `phppos_sales_work_orders` (`id`),
  CONSTRAINT `phppos_work_order_log_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `phppos_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_work_order_log`
--

LOCK TABLES `phppos_work_order_log` WRITE;
/*!40000 ALTER TABLE `phppos_work_order_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_work_order_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_work_orders_email_templates`
--

DROP TABLE IF EXISTS `phppos_work_orders_email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_work_orders_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_work_orders_email_templates`
--

LOCK TABLES `phppos_work_orders_email_templates` WRITE;
/*!40000 ALTER TABLE `phppos_work_orders_email_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_work_orders_email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_workorder_checkbox_groups`
--

DROP TABLE IF EXISTS `phppos_workorder_checkbox_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_workorder_checkbox_groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sort_order` int(10) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `sort_index` (`deleted`,`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_workorder_checkbox_groups`
--

LOCK TABLES `phppos_workorder_checkbox_groups` WRITE;
/*!40000 ALTER TABLE `phppos_workorder_checkbox_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_workorder_checkbox_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_workorder_checkboxes`
--

DROP TABLE IF EXISTS `phppos_workorder_checkboxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_workorder_checkboxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `group_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `phppos_workorder_checkboxes_ibfk_1` (`group_id`),
  CONSTRAINT `phppos_workorder_checkboxes_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `phppos_workorder_checkbox_groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_workorder_checkboxes`
--

LOCK TABLES `phppos_workorder_checkboxes` WRITE;
/*!40000 ALTER TABLE `phppos_workorder_checkboxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_workorder_checkboxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_workorder_checkboxes_states`
--

DROP TABLE IF EXISTS `phppos_workorder_checkboxes_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_workorder_checkboxes_states` (
  `checkbox_id` int(10) NOT NULL,
  `workorder_id` int(10) NOT NULL,
  PRIMARY KEY (`checkbox_id`,`workorder_id`) USING BTREE,
  KEY `workorder_id` (`workorder_id`),
  CONSTRAINT `phppos_workorder_checkboxes_states_ibfk_1` FOREIGN KEY (`workorder_id`) REFERENCES `phppos_sales_work_orders` (`id`),
  CONSTRAINT `phppos_workorder_checkboxes_states_ibfk_2` FOREIGN KEY (`checkbox_id`) REFERENCES `phppos_workorder_checkboxes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_workorder_checkboxes_states`
--

LOCK TABLES `phppos_workorder_checkboxes_states` WRITE;
/*!40000 ALTER TABLE `phppos_workorder_checkboxes_states` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_workorder_checkboxes_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_workorder_statuses`
--

DROP TABLE IF EXISTS `phppos_workorder_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_workorder_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `notify_by_email` tinyint(1) DEFAULT 0,
  `notify_by_sms` tinyint(1) DEFAULT 0,
  `color` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_workorder_statuses`
--

LOCK TABLES `phppos_workorder_statuses` WRITE;
/*!40000 ALTER TABLE `phppos_workorder_statuses` DISABLE KEYS */;
INSERT INTO `phppos_workorder_statuses` VALUES (1,'lang:work_orders_new',NULL,0,0,'#4594cc',10,'2020-07-09 09:32:32'),(2,'lang:work_orders_in_progress',NULL,0,0,'#28a745',20,'2020-07-09 09:32:47'),(3,'lang:work_orders_out_for_repair',NULL,0,0,'#f7ac08',30,'2020-07-09 09:32:54'),(4,'lang:work_orders_waiting_on_customer',NULL,0,0,'#6a0dad',40,'2020-07-09 09:33:01'),(5,'lang:work_orders_repaired',NULL,0,0,'#006400',50,'2020-07-09 09:33:09'),(6,'lang:work_orders_complete',NULL,0,0,'#28a745',60,'2020-07-09 09:33:17'),(7,'lang:work_orders_cancelled',NULL,0,0,'#fb5d5d',70,'2020-07-09 09:33:34');
/*!40000 ALTER TABLE `phppos_workorder_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_zatca_config`
--

DROP TABLE IF EXISTS `phppos_zatca_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_zatca_config` (
  `location_id` int(10) NOT NULL,
  `csr_common_name` text NOT NULL,
  `csr_serial_number` text NOT NULL,
  `csr_organization_identifier` text NOT NULL,
  `csr_organization_unit_name` text NOT NULL,
  `csr_organization_name` text NOT NULL,
  `csr_country_name` text NOT NULL,
  `csr_invoice_type` text NOT NULL,
  `csr_location_address` text NOT NULL,
  `csr_industry_business_category` text NOT NULL,
  `seller_party_postal_street_name` varchar(100) NOT NULL,
  `seller_party_postal_building_number` varchar(100) NOT NULL,
  `seller_party_postal_code` varchar(100) NOT NULL,
  `seller_party_postal_city` varchar(100) NOT NULL,
  `seller_party_postal_district` varchar(100) NOT NULL,
  `seller_party_postal_plot_id` varchar(100) NOT NULL,
  `seller_party_postal_country` varchar(10) NOT NULL,
  `seller_id` varchar(100) NOT NULL,
  `seller_scheme_id` varchar(10) NOT NULL,
  `seller_tax_id` varchar(100) NOT NULL,
  `csr` text NOT NULL,
  `csr_private_key` text NOT NULL,
  `private_key` text NOT NULL,
  `cert` text NOT NULL,
  `compliance_csid` text NOT NULL,
  `production_csid` text NOT NULL,
  UNIQUE KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_zatca_config`
--

LOCK TABLES `phppos_zatca_config` WRITE;
/*!40000 ALTER TABLE `phppos_zatca_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_zatca_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_zatca_invoices`
--

DROP TABLE IF EXISTS `phppos_zatca_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_zatca_invoices` (
  `invoice_id` int(10) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `sale_id` int(10) NOT NULL,
  `PIH` text NOT NULL,
  `hash` text NOT NULL,
  `qr_code` text NOT NULL,
  `invoice_data` text NOT NULL,
  `invoice_type_code` varchar(20) NOT NULL,
  `invoice_subtype` varchar(20) NOT NULL,
  `invoice_xml` text NOT NULL,
  `invoice_xml_sign` text DEFAULT NULL,
  `validate` tinyint(1) NOT NULL DEFAULT 0,
  `invoice_request` text NOT NULL,
  `clearance_response` text NOT NULL,
  `reporting_response` text NOT NULL,
  `reported` tinyint(4) NOT NULL,
  `check_compliance` tinyint(4) NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` text NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_zatca_invoices`
--

LOCK TABLES `phppos_zatca_invoices` WRITE;
/*!40000 ALTER TABLE `phppos_zatca_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_zatca_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phppos_zips`
--

DROP TABLE IF EXISTS `phppos_zips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phppos_zips` (
  `name` varchar(255) NOT NULL,
  `shipping_zone_id` int(10) DEFAULT NULL,
  `order` int(10) NOT NULL DEFAULT 0,
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`),
  KEY `phppos_zips_ibfk_1` (`shipping_zone_id`),
  CONSTRAINT `phppos_zips_ibfk_1` FOREIGN KEY (`shipping_zone_id`) REFERENCES `phppos_shipping_zones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phppos_zips`
--

LOCK TABLES `phppos_zips` WRITE;
/*!40000 ALTER TABLE `phppos_zips` DISABLE KEYS */;
/*!40000 ALTER TABLE `phppos_zips` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-23 16:45:28
