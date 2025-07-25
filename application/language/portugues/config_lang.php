<?php
$lang['config_info']='Informação de Configuração da Loja';

$lang['config_address']='Endereço da Empresa';
$lang['config_phone']='Telefone da Empresa';
$lang['config_prefix']='ID Prefixo de Venda';
$lang['config_website']='Site';
$lang['config_fax']='Fax';
$lang['config_default_tax_rate']='Taxa de Imposto % Padrão';


$lang['config_company_required']='Nome da empresa é um campo obrigatório';

$lang['config_phone_required']='Telefone da empresa é um campo obrigatório';
$lang['config_sale_prefix_required']='ID Prefixo de Venda é um campo obrigatório';
$lang['config_default_tax_rate_required']='A taxa de imposto padrão é um campo obrigatório';
$lang['config_default_tax_rate_number']='A taxa de imposto padrão deve ser um número';
$lang['config_company_website_url']='O site da empresa não é um URL válido (http://...)';

$lang['config_saved_unsuccessfully']='Falha ao guardar a configuração. As alterações de configuração não são permitidas em modo de demonstração ou os impostos não foram guardados corretamente';
$lang['config_return_policy_required']='Política de devolução é um campo obrigatório';
$lang['config_print_after_sale']='Imprimir recibo após venda';
$lang['config_automatically_email_receipt']='Recibo no email automaticamente';
$lang['config_barcode_price_include_tax']='Incluem imposto sobre os códigos de barras';
$lang['disable_confirmation_sale']='Desactivar a confirmação de venda completa';


$lang['config_currency_symbol'] = 'Símbolo da Moeda';
$lang['config_backup_database'] = 'Backup de Base de Dados';
$lang['config_restore_database'] = 'Restaurar Base de Dados';

$lang['config_number_of_items_per_page'] = 'Número de Itens Por Página';
$lang['config_date_format'] = 'Formato da Data';
$lang['config_time_format'] = 'Formato da Hora';
$lang['config_company_logo'] = 'Logotipo da Empresa';
$lang['config_delete_logo'] = 'Apagar Logotipo';

$lang['config_database_optimize_successfully'] = 'Base de Dados Otimizada Com Sucesso';
$lang['config_payment_types'] = 'Formas de Pagamento';
$lang['select_sql_file'] = 'seleccionar arquivo .sql';

$lang['restore_heading'] = 'Isto permite-lhe restaurar a base de dados';

$lang['type_file'] = 'seleccione arquivo .sql do seu computador';

$lang['restore'] = 'restaurar';

$lang['required_sql_file'] = 'Não está seleccionado nenhum ficheiro sql';

$lang['restore_db_success'] = 'Base de dados restaurada com êxito';

$lang['db_first_alert'] = 'Tem a certeza que quer restaurar a base de dados?';
$lang['db_second_alert'] = 'Os dados atuais serão perdidos, continuar?';
$lang['password_error'] = 'Palavra-passe incorreta';
$lang['password_required'] = 'Campo de palavra-passe não pode ficar em branco';
$lang['restore_database_title'] = 'Restaurar Base de Dados';



$lang['config_environment'] = 'Ambiente';


$lang['config_sandbox'] = 'Sandbox';
$lang['config_production'] = 'Produção';

$lang['config_default_payment_type'] = 'Tipo de Pagamento Padrão';
$lang['config_speed_up_note'] = 'Recomendar apenas se tiver mais de 10,000 itens ou clientes';
$lang['config_hide_signature'] = 'Ocultar Assinatura';
$lang['config_round_cash_on_sales'] = 'Arredondar para o mais próximo .05 no recibo';
$lang['config_customers_store_accounts'] = 'Contas de Clientes da Loja';
$lang['config_change_sale_date_when_suspending'] = 'Alterar data de venda quando suspende a venda';
$lang['config_change_sale_date_when_completing_suspended_sale'] = 'Alterar data de venda quando completa venda suspensa';
$lang['config_price_tiers'] = 'Níveis de preço';
$lang['config_add_tier'] = 'Adicionar nível';
$lang['config_show_receipt_after_suspending_sale'] = 'Mostrar recibo após suspensão de venda';
$lang['config_backup_overview'] = 'Visão Geral do Backup';
$lang['config_backup_overview_desc'] = 'O backup dos seus dados é muito importante, mas pode ser problemático com grandes quantidades de dados. Se tiver muitas imagens, itens e vendas e isso pode aumentar o tamanho da sua base de dados.';
$lang['config_backup_options'] = 'Oferecemos muitas opções de backup para ajudar a decidir como proceder';
$lang['config_backup_simple_option'] = 'Clicar em "Backup da base de dados". Isto irá tentar descarregar toda a sua base de dados para um ficheiro. Se receber um ecrã em branco ou não conseguir descarregar o ficheiro, tente uma das outras opções.';
$lang['config_backup_phpmyadmin_1'] = 'O PHPMyAdmin é uma ferramenta popular para gerir as suas bases de dados. Se estiver a usar a versão de download com programa de instalação, pode ser acedido ao ir para';
$lang['config_backup_phpmyadmin_2'] = 'O seu nome de utilizador é a raiz e a palavra-passe é a que usou na instalação inicial do %BRANDING_SHORT_NAME%. Quando entrar seleccione a base de dados no painel da esquerda. Depois seleccione exportar e envie o formulário.';
$lang['config_backup_control_panel'] = 'Se instalou no seu próprio servidor que tem um painel de controlo como o cpanel, procure o módulo de backup que geralmente deixa descarregar backups da sua base de dados.';
$lang['config_backup_mysqldump'] = 'Se você tiver acesso ao shell e mysqldump no seu servidor, pode tentar executá-lo ao clicar no link abaixo. Caso contrário, terá de tentar outras opções.';
$lang['config_mysqldump_failed'] = 'backup do mysqldump falhou. Isto pode ser devido a uma restrição do servidor ou o comando pode não estar disponível. Por favor, tente outro método de backup';



$lang['config_looking_for_location_settings'] = 'À procura de outras opções de configuração? Vá a';
$lang['config_module'] = 'Módulo';
$lang['config_automatically_calculate_average_cost_price_from_receivings'] = 'Calcular a Média de Preço de Custo de Recebimentos';
$lang['config_averaging_method'] = 'Método de Cálculo da Média';
$lang['config_historical_average'] = 'Média Histórica';
$lang['config_moving_average'] = 'Média Móvel';

$lang['config_hide_dashboard_statistics'] = 'Ocultar Estatísticas do Painel';
$lang['config_hide_store_account_payments_in_reports'] = 'Ocultar Pagamentos da Conta de Loja nos Relatórios';
$lang['config_id_to_show_on_sale_interface'] = 'ID do Item para Mostrar na Interface de Vendas';
$lang['config_auto_focus_on_item_after_sale_and_receiving'] = 'Foco automático No Campo do Item Quando utilizar Interfaces de Vendas/Recebimentos';
$lang['config_automatically_show_comments_on_receipt'] = 'Mostrar Automaticamente Comentários no Recibo';
$lang['config_hide_customer_recent_sales'] = 'Ocultar Vendas Recentes para o Clientes';
$lang['config_spreadsheet_format'] = 'Formato de Folha de Cálculo';
$lang['config_csv'] = 'CSV';
$lang['config_xlsx'] = 'XLSX';
$lang['config_disable_giftcard_detection'] = 'Desativar Deteção De Cartão Presente';
$lang['config_disable_subtraction_of_giftcard_amount_from_sales'] = 'Desativar subtração de cartão presente quando usa cartão presente durante a venda';
$lang['config_always_show_item_grid'] = 'Mostrar Sempre Grelha de Itens';
$lang['config_legacy_detailed_report_export'] = 'Exportar Excel de Relatório Detalhado de Legado';
$lang['config_print_after_receiving'] = 'Imprimir recibo após receber';
$lang['config_company_info'] = 'Informação da Empresa';


$lang['config_suspended_sales_layaways_info'] = 'Vendas Suspensas/Reservas';
$lang['config_application_settings_info'] = 'Configurações da Aplicação';
$lang['config_hide_barcode_on_sales_and_recv_receipt'] = 'Ocultar código de barras nos recibos';
$lang['config_round_tier_prices_to_2_decimals'] = 'Arredondar Preços de nível para 2 casas decimais';
$lang['config_group_all_taxes_on_receipt'] = 'Agrupar todos os impostos no recibo';
$lang['config_receipt_text_size'] = 'Tamanho de texto do recibo';
$lang['config_small'] = 'Pequeno';
$lang['config_medium'] = 'Médio';
$lang['config_large'] = 'Grande';
$lang['config_extra_large'] = 'Extra grande';
$lang['config_select_sales_person_during_sale'] = 'Selecionar vendedor durante a venda';
$lang['config_default_sales_person'] = 'Vendedor predefinido';
$lang['config_require_customer_for_sale'] = 'Exigir cliente para venda';

$lang['config_hide_store_account_payments_from_report_totals'] = 'Ocultar pagamentos de conta da loja dos totais de relatórios';
$lang['config_disable_sale_notifications'] = 'Desativar notificações de venda';
$lang['config_id_to_show_on_barcode'] = 'ID a mostrar no código de barras';
$lang['config_currency_denoms'] = 'Denominações de Moeda';
$lang['config_currency_value'] = 'Valor da Moeda';
$lang['config_add_currency_denom'] = 'Adicionar denominação da moeda';
$lang['config_enable_timeclock'] = 'Ativar o Relógio';
$lang['config_change_sale_date_for_new_sale'] = 'Alterar Data de Venda para Nova Venda';
$lang['config_dont_average_use_current_recv_price'] = 'Não fazer média, usar o atual preço recebido';
$lang['config_number_of_recent_sales'] = 'Número de vendas recentes pelo cliente a mostrar';
$lang['config_hide_suspended_recv_in_reports'] = 'Ocultar Recebimentos suspensos nos relatórios';
$lang['config_calculate_profit_for_giftcard_when'] = 'Calcular Lucro do Cartão Presente Quando';
$lang['config_selling_giftcard'] = 'Venda de Cartão Presente';
$lang['config_redeeming_giftcard'] = 'Resgate de Cartão Presente';
$lang['config_remove_customer_contact_info_from_receipt'] = 'Remover informações de contato do cliente do recibo';
$lang['config_speed_up_search_queries'] = 'Acelerar consultas de pesquisa?';




$lang['config_redirect_to_sale_or_recv_screen_after_printing_receipt'] = 'Redirecionar para ecrã de venda ou recebimento após impressão do recibo';
$lang['config_enable_sounds'] = 'Activar sons para mensagens de estado';
$lang['config_charge_tax_on_recv'] = 'Cobrar impostos sobre recebimentos';
$lang['config_report_sort_order'] = 'Relatório de Ordem de Classificação';
$lang['config_asc'] = 'Mais antigo primeiro';
$lang['config_desc'] = 'Mais recente primeiro';
$lang['config_do_not_group_same_items'] = 'NÃO agrupar itens que são os mesmos';
$lang['config_show_item_id_on_receipt'] = 'Mostrar ID do item no recibo';
$lang['config_show_language_switcher'] = 'Mostrar Alterador de Língua';
$lang['config_do_not_allow_out_of_stock_items_to_be_sold'] = 'Não permitir venda de itens fora de stock';
$lang['config_number_of_items_in_grid'] = 'Número de itens por página em grelha';
$lang['config_edit_item_price_if_zero_after_adding'] = 'Editar preço do item se 0 após adicionar à venda';
$lang['config_override_receipt_title'] = 'Substituir o título de recibo';
$lang['config_automatically_print_duplicate_receipt_for_cc_transactions'] = 'Imprimir duplicado do recibo automaticamente para transações de cartão de crédito';





$lang['config_default_type_for_grid'] = 'Tipo de Grelha padrão';
$lang['config_billing_is_managed_through_paypal'] = 'A facturação é gerida através do <a target="_blank" href="http://paypal.com">Paypal</a>. Pode cancelar a subscrição ao clicar <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=BNTRX72M8UZ2E">aqui</a>. pode<a href="http://%BRANDING_DOMAIN%/update_billing.php" target="_blank">actualizar a facturação aqui</a>.';
$lang['config_cannot_change_language'] = 'O idioma não pode ser salvo no nível da aplicação. No entanto, o empregado de administrador padrão pode alterar o idioma usando o seletor no cabeçalho do programa';
$lang['disable_quick_complete_sale'] = 'Desativar venda rápida completo';
$lang['config_fast_user_switching'] = 'Activar a mudança rápida de utilizador (a palavra-passe não é necessária)';
$lang['config_require_employee_login_before_each_sale'] = 'Exigir entrada do funcionário antes de cada venda';
$lang['config_keep_same_location_after_switching_employee'] = 'Manter o mesmo local após mudança do funcionário';
$lang['config_number_of_decimals'] = 'Número de decimais';
$lang['config_let_system_decide'] = 'Deixar o sistema decidir (Recomendado)';
$lang['config_thousands_separator'] = 'Separador De Milhares';
$lang['config_enhanced_search_method'] = 'Método de Pesquisa Avançado';
$lang['config_hide_store_account_balance_on_receipt'] = 'Ocultar saldo de conta da loja no recibo';
$lang['config_decimal_point'] = 'Ponto Decimal';
$lang['config_hide_out_of_stock_grid'] = 'Ocultar itens fora de stock na grelha';
$lang['config_highlight_low_inventory_items_in_items_module'] = 'Destacar itens de baixo stock no módulo de itens';
$lang['config_sort'] = 'Ordenar';
$lang['config_enable_customer_loyalty_system'] = 'Ativar sistema de Fidelização de Clientes';
$lang['config_spend_to_point_ratio'] = 'Relação montante gasto para pontos';
$lang['config_point_value'] = 'Valor do Ponto';
$lang['config_hide_points_on_receipt'] = 'Ocultar Pontos no Recibo';
$lang['config_show_clock_on_header'] = 'Mostrar Relógio no Cabeçalho';
$lang['config_show_clock_on_header_help_text'] = 'Isto é visível apenas em telas grandes';
$lang['config_loyalty_explained_spend_amount'] = 'Introduza o valor a gastar';
$lang['config_loyalty_explained_points_to_earn'] = 'Introduzir pontos a serem ganhos';
$lang['config_simple'] = 'Simples';
$lang['config_advanced'] = 'avançado';
$lang['config_loyalty_option'] = 'Opção de Programa de Fidelidade';
$lang['config_number_of_sales_for_discount'] = 'Número de vendas para desconto';
$lang['config_discount_percent_earned'] = 'Descontar percentagem ganha quando atingir as vendas';
$lang['hide_sales_to_discount_on_receipt'] = 'Ocultar vendas com desconto no recibo';
$lang['config_hide_price_on_barcodes'] = 'Ocultar preço nos códigos de barras';
$lang['config_always_use_average_cost_method'] = 'Sempre Uso Global Média Preço de custo para um item de venda Preço de custo. (NÃO verifique se você não sabe o que isso significa)';

$lang['config_test_mode_help'] = 'Vendas NÃO guardadas';
$lang['config_require_customer_for_suspended_sale'] = 'Exigir ao cliente a venda suspensa';
$lang['config_default_new_items_to_service'] = 'Como padrão definir novos itens como itens de serviço';






$lang['config_prompt_for_ccv_swipe'] = 'Solicitar CCV quando passam cartão de crédito';
$lang['config_disable_store_account_when_over_credit_limit'] = 'Desativar conta de loja quando ultrapassado o limite de crédito';
$lang['config_mailing_labels_type'] = 'Formato de Etiquetas de Endereços';
$lang['config_phppos_session_expiration'] = 'Expiração de sessão';
$lang['config_hours'] = 'Horas';
$lang['config_never'] = 'Nunca';
$lang['config_on_browser_close'] = 'No Encerramento Do Navegador';
$lang['config_do_not_allow_below_cost'] = 'NÃO permitir que os itens sejam vendidos abaixo do preço de custo';
$lang['config_store_account_statement_message'] = 'Mensagem de Declaração de Conta de Loja';
$lang['config_enable_markup_calculator'] = 'Ativar Mark Up Calculator';
$lang['config_enable_quick_edit'] = 'Habilitar edição rápida de gerenciar páginas';
$lang['config_show_orig_price_if_marked_down_on_receipt'] = 'Mostrar preço original no momento da recepção, se marcado para baixo';
$lang['config_cancel_account'] = 'Cancelar conta';
$lang['config_update_billing'] = 'Você pode atualizar e cancelar suas informações de faturamento, clicando nos botões a seguir:';
$lang['config_include_child_categories_when_searching_or_reporting'] = 'Incluir categorias filho durante a pesquisa ou relatórios';
$lang['config_confirm_error_messages_modal'] = 'Confirmar mensagens de erro usando diálogos modais';
$lang['config_remove_commission_from_profit_in_reports'] = 'Remover comissão do lucro em relatórios';
$lang['config_remove_points_from_profit'] = 'Remover pontos redenção do lucro';
$lang['config_capture_sig_for_all_payments'] = 'assinatura de captura para todas as vendas';
$lang['config_suppliers_store_accounts'] = 'Fornecedores Contas da Loja';
$lang['config_currency_symbol_location'] = 'Símbolo de moeda Localização';
$lang['config_before_number'] = 'antes Número';
$lang['config_after_number'] = 'após Número';
$lang['config_hide_desc_on_receipt'] = 'Esconder Descrição na Receipt';
$lang['config_default_percent_off'] = 'Percentagem de Desconto padrão';
$lang['config_default_cost_plus_percent'] = 'Custo padrão Além disso Percent';
$lang['config_default_tier_percent_type_for_excel_import'] = 'Padrão de Nível Tipo cento para excel importação';
$lang['config_override_tier_name'] = 'Substituir Nível Nome na Receipt';
$lang['config_loyalty_points_without_tax'] = 'Os pontos de fidelidade ganho não incluindo impostos';
$lang['config_lock_prices_suspended_sales'] = 'preços de bloqueio quando Reativando venda, mesmo se eles pertencem a uma camada';
$lang['config_remove_customer_name_from_receipt'] = 'Remover Nome do cliente a partir do recebimento';
$lang['config_scale_1'] = 'UPC-12 4 dígitos de preços';
$lang['config_scale_2'] = 'UPC-12 5 dígitos Preço';
$lang['config_scale_3'] = 'EAN-13 5 dígitos preços';
$lang['config_scale_4'] = 'EAN-13 6 dígitos de preços';
$lang['config_scale_format'] = 'Formato escala de código de barras';
;
$lang['config_enable_scale'] = 'Ativar Scale';
$lang['config_scale_divide_by'] = 'Escala Preço divisão por';
$lang['config_logout_on_clock_out'] = 'Sair automaticamente quando bater o ponto';
$lang['config_user_configured_layaway_name'] = 'Substituir Nome Layaway';
$lang['config_use_tax_value_at_all_locations'] = 'Utilize valores dos impostos em todos os locais';
$lang['config_enable_ebt_payments'] = 'Permitir pagamentos EBT';
$lang['config_item_id_auto_increment'] = 'Item ID Auto Incremento valor inicial';
$lang['config_change_auto_increment_item_id_unsuccessful'] = 'Houve um erro ao alterar auto_increment para item_id';
$lang['config_item_kit_id_auto_increment'] = 'Kit Item ID Auto Incremento valor inicial';
$lang['config_sale_id_auto_increment'] = 'Venda ID Auto Incremento valor inicial';
$lang['config_receiving_id_auto_increment'] = 'Receber ID Auto Incremento valor inicial';
$lang['config_change_auto_increment_item_kit_id'] = 'Houve um erro ao alterar auto_increment para Iitem_kit_id';
$lang['config_change_auto_increment_sale_id'] = 'Houve um erro ao alterar auto_increment para sale_id';
$lang['config_change_auto_increment_receiving_id'] = 'Houve um erro ao alterar auto_increment para receiving_id';
$lang['config_auto_increment_note'] = 'Você só pode aumentar os valores de incremento automático. Atualizá-los não afetará IDs de itens, kits de itens, vendas ou recebimentos que já existem.';
$lang['config_online_price_tier'] = 'Nível de preço on-line';
$lang['config_woo_api_key'] = 'Woocommerce Key API';
$lang['config_email_settings_info'] = 'Configurações de e-mail';

$lang['config_last_sync_date'] = 'Data da Última Sincronização';
$lang['config_sync'] = 'Sincronizar';

$lang['config_smtp_crypto'] = 'Criptografia SMTP';
$lang['config_email_protocol'] = 'Enviando Correio protocolo';
$lang['config_smtp_host'] = 'SMTP Server Address';
$lang['config_smtp_user'] = 'Endereço de e-mail';
$lang['config_smtp_pass'] = 'senha do e-mail';
$lang['config_smtp_port'] = 'Porta SMTP';
$lang['config_email_charset'] = 'Conjunto de caracteres';
$lang['config_email_newline'] = 'caractere de nova linha';
$lang['config_email_crlf'] = 'CRLF';
$lang['config_smtp_timeout'] = 'SMTP Timeout';
$lang['config_send_test_email'] = 'Enviar email de teste';
$lang['config_please_enter_email_to_send_test_to'] = 'Por favor insira o endereço de e-mail para enviar e-mail de teste para';
$lang['config_email_succesfully_sent'] = 'E-mail foi enviada com sucesso';
$lang['config_taxes_info'] = 'Impostos';
$lang['config_currency_info'] = 'Moeda';

$lang['config_receipt_info'] = 'Recibo';

$lang['config_barcodes_info'] = 'Códigos de barra';
$lang['config_customer_loyalty_info'] = 'Lealdade do consumidor';
$lang['config_price_tiers_info'] = 'Tiers Preço';
$lang['config_auto_increment_ids_info'] = 'Números de ID';
$lang['config_items_info'] = 'Unid';
$lang['config_employee_info'] = 'Empregado';
$lang['config_store_accounts_info'] = 'Contas de loja';
$lang['config_sales_info'] = 'Vendas';
$lang['config_payment_types_info'] = 'Tipos de pagamento';
$lang['config_profit_info'] = 'Cálculo de lucro';
$lang['reports_view_dashboard_stats'] = 'Visualização do painel Estatísticas';
$lang['config_keyword_email'] = 'configurações de e-mail';
$lang['config_keyword_company'] = 'companhia';
$lang['config_keyword_taxes'] = 'impostos';
$lang['config_keyword_currency'] = 'moeda';
$lang['config_keyword_payment'] = 'Forma de pagamento';
$lang['config_keyword_sales'] = 'vendas';
$lang['config_keyword_suspended_layaways'] = 'lay awans suspensos';
$lang['config_keyword_receipt'] = 'recibo';
$lang['config_keyword_profit'] = 'lucro';
$lang['config_keyword_barcodes'] = 'códigos de barra';
$lang['config_keyword_customer_loyalty'] = 'lealdade do consumidor';
$lang['config_keyword_price_tiers'] = 'níveis de preços';
$lang['config_keyword_auto_increment'] = 'começando auto incremento de banco de dados números de identificação';
$lang['config_keyword_items'] = 'Unid';
$lang['config_keyword_employees'] = 'funcionários';
$lang['config_keyword_store_accounts'] = 'contas de loja';
$lang['config_keyword_application_settings'] = 'configurações do aplicativo';
$lang['config_keyword_ecommerce'] = 'plataforma de comércio eletrônico';
$lang['config_keyword_woocommerce'] = 'configurações woocommerce ecommerce';
$lang['config_billing_info'] = 'Informações de pagamento';
$lang['config_keyword_billing'] = 'faturamento cancelar atualização';
$lang['config_woo_version'] = 'WooCommerce Versão';

$lang['sync_phppos_item_changes'] = 'alterações item de sincronização';
$lang['config_sync_phppos_item_changes'] = 'alterações item de sincronização';
$lang['config_import_ecommerce_items_into_phppos'] = 'Importar itens para %BRANDING_SHORT_NAME%';
$lang['config_sync_inventory_changes'] = 'alterações de inventário de sincronização';
$lang['config_export_phppos_tags_to_ecommerce'] = 'etiquetas de exportação para comércio eletrônico';
$lang['config_export_phppos_categories_to_ecommerce'] = 'Categorias de exportação para comércio eletrônico';
$lang['config_export_phppos_items_to_ecommerce'] = 'itens de exportação para comércio eletrônico';
$lang['config_ecommerce_cron_sync_operations'] = 'Ecommerce operações de sincronização';
$lang['config_ecommerce_progress'] = 'sincronização Progress';
$lang['config_woocommerce_settings_info'] = 'Configurações Woocommerce';
$lang['config_store_location'] = 'Localização da loja';
$lang['config_woo_api_secret'] = 'Woocommerce API Segredo';
$lang['config_woo_api_url'] = 'Woocommerce API Url';
$lang['config_ecommerce_settings_info'] = 'Plataforma Ecommerce';
$lang['config_ecommerce_platform'] = 'Selecionar plataforma';
$lang['config_magento_settings_info'] = 'Configurações de Magento';
$lang['config_reset_location_when_switching_employee'] = 'Repor localização quando se muda empregado';
$lang['confirmation_woocommerce_cron_cancel'] = 'Tem certeza de que deseja cancelar a sincronização?';
$lang['config_force_https'] = 'Exigir https para o programa';

$lang['config_keyword_price_rules'] = 'Regras de preços';
$lang['config_disable_price_rules_dialog'] = 'Desativar diálogo Regras de Preço';
$lang['config_price_rules_info'] = 'Regras de preços';

$lang['config_prompt_to_use_points'] = 'Prompt de usar pontos quando disponível';



$lang['config_always_print_duplicate_receipt_all'] = 'Sempre imprimir duplicado recibo para todas as transações';


$lang['config_orders_and_deliveries_info'] = 'Encomendas e entregas';
$lang['config_delivery_methods'] = 'Métodos de entrega';
$lang['config_shipping_providers'] = 'Fornecedores de remessa';
$lang['config_expand'] = 'Expandir';
$lang['config_add_delivery_rate'] = 'Adicionar taxa de entrega';
$lang['config_add_shipping_provider'] = 'Adicionar fornecedor de envio';
$lang['config_delivery_rates'] = 'Taxas de Entrega';
$lang['config_delivery_fee'] = 'Taxa de entrega';
$lang['config_keyword_orders_deliveries'] = 'Ordena entregas de entrega';
$lang['config_delivery_fee_tax'] = 'Taxa de Entrega';
$lang['config_add_rate'] = 'Adicionar Taxa';
$lang['config_delivery_time'] = 'Tempo de entrega em dias';
$lang['config_delivery_rate'] = 'Taxa de entrega';
$lang['config_rate_name'] = 'Nome da Taxa';
$lang['config_rate_fee'] = 'Taxa de Taxa';
$lang['config_rate_tax'] = 'Taxa de imposto';
$lang['config_tax_classes'] = 'Grupos Fiscais';
$lang['config_add_tax_class'] = 'Adicionar Grupo Fiscal';

$lang['config_wide_printer_receipt_format'] = 'Formato de recebimento de impressora amplo';

$lang['config_default_cost_plus_fixed_amount'] = 'Valor padrão mais fixo';
$lang['config_default_tier_fixed_type_for_excel_import'] = 'Montante fixo de nível padrão para importação do Excel';
$lang['config_default_reorder_level_when_creating_items'] = 'Nível de reordenação padrão ao criar itens';
$lang['config_remove_customer_company_from_receipt'] = 'Remova o nome da empresa do cliente do recibo';

$lang['config_import_ecommerce_categories_into_phppos'] = 'Importe categorias para phpo';
$lang['config_import_ecommerce_tags_into_phppos'] = 'Importa tags em %BRANDING_SHORT_NAME%';

$lang['config_shipping_zones'] = 'Zonas marítimas';
$lang['config_add_shipping_zone'] = 'Adicionar Zona de Envio';
$lang['config_no_results'] = 'Sem resultados';
$lang['config_zip_search_term'] = 'Digite um código postal';
$lang['config_searching'] = 'Procurando...';
$lang['config_tax_class'] = 'Grupo de impostos';
$lang['config_zone'] = 'Zona';

$lang['config_zip_codes'] = 'CEP';
$lang['config_add_zip_code'] = 'Adicionar código postal';
$lang['config_ecom_sync_logs'] = 'E-Commerce Syncing Logs';
$lang['config_currency_code'] = 'Código da moeda';

$lang['config_add_currency_exchange_rate'] = 'Adicionar taxa de câmbio';
$lang['config_currency_exchange_rates'] = 'Taxas de câmbio';
$lang['config_exchange_rate'] = 'Taxa de câmbio';
$lang['config_item_lookup_order'] = 'Ordem de pesquisa de itens';
$lang['config_item_id'] = 'ID do item';
$lang['config_reset_ecommerce'] = 'Redefinir o comércio eletrônico';
$lang['config_confirm_reset_ecom'] = 'Tem certeza de que deseja redefinir o comércio eletrônico? Isso só irá redefinir o ponto de venda php para que os itens não estejam mais vinculados';
$lang['config_reset_ecom_successfully'] = 'Você reiniciou o E-Commerce com sucesso';
$lang['config_number_of_decimals_for_quantity_on_receipt'] = 'Número de decimais para quantidade no recibo';
$lang['config_enable_wic'] = 'Ativar WIC';
$lang['config_store_opening_time'] = 'Hora de abertura da loja';
$lang['config_store_closing_time'] = 'Tempo de encerramento da loja';
$lang['config_limit_manual_price_adj'] = 'Limite os ajustes e descontos manuais do preço';
$lang['config_always_minimize_menu'] = 'Minimizar sempre o menu da barra lateral esquerda';

$lang['config_emailed_receipt_subject'] = 'Assunto de recebimento de e-mail';

$lang['config_do_not_tax_service_items_for_deliveries'] = 'NÃO taxe itens de serviço para entregas';


$lang['config_do_not_show_closing'] = 'Não mostre o valor de fechamento esperado ao fechar o registro';

$lang['config_paypal_me'] = 'Nome de usuário PayPal.me';


$lang['config_show_barcode_company_name'] = 'Mostrar o nome da empresa no código de barra';
$lang['config_import_ecommerce_attributes_into_phppos'] = 'Importar atributos para phpo';
$lang['config_export_phppos_attributes_to_ecommerce'] = 'Atributos de exportação para comércio eletrônico';

$lang['config_sku_sync_field'] = 'Campo SKU para sincronizar com';



$lang['config_overwrite_existing_items_on_excel_import'] = 'Substitua itens existentes na importação de excel';

$lang['config_add_suspended_sale_type'] = 'Adicionar tipo de venda suspensa';
$lang['config_additional_suspend_types'] = 'Tipos de venda suspensa adicional';
$lang['config_remove_employee_from_receipt'] = 'Remover nome do empregado do recibo';
$lang['config_import_ecommerce_orders_into_phppos'] = 'Importar ordens para phpo';
$lang['import_ecommerce_orders_into_phppos'] = 'Ordens de importação em %BRANDING_SHORT_NAME%';
$lang['config_hide_name_on_barcodes'] = 'Ocultar nome nos códigos de barra';


$lang['config_api_settings_info'] = 'Configurações da API';
$lang['config_keyword_api'] = 'API';
$lang['config_api_keys'] = 'API Keys';
$lang['config_api_key_ending_in'] = 'Chave da API terminada em';
$lang['config_permissions'] = 'Permissões';
$lang['config_last_access'] = 'Último acesso';
$lang['config_add_key'] = 'Adicionar chave da API';
$lang['config_api_key'] = 'Chave API';
$lang['config_read'] = 'Ler';
$lang['config_read_write'] = 'Ler escrever';
$lang['config_submit_api_key'] = 'Tem certeza de que deseja adicionar essa chave? Certifique-se de ter copiado a chave para a localização segura, pois não será exibida novamente.';
$lang['config_write'] = 'Escreva';
$lang['config_api_key_confirm_delete'] = 'Tem certeza de que deseja excluir esta chave api?';
$lang['config_key_copied_to_clipboard'] = 'Chave Copiada para a Área de Transferência';

$lang['config_new_items_are_ecommerce_by_default'] = 'Novos itens são E-Commerce por padrão';


$lang['config_new_items_are_ecommerce_by_default'] = 'Novos itens são E-Commerce por padrão';

$lang['config_hide_description_on_sales_and_recv'] = 'Ocultar descrição nas interfaces de vendas e receivings';





$lang['config_hide_item_descriptions_in_reports'] = 'Esconda a descrição do item nos relatórios';





$lang['config_do_not_allow_item_with_variations_to_be_sold_without_selecting_variation'] = 'NÃO permita que os itens de variação sejam vendidos sem selecionar a variação';



$lang['config_verify_age_for_products'] = 'Verificar idade para produtos';
$lang['config_default_age_to_verify'] = 'Idade padrão para verificar';




$lang['config_remind_customer_facing_display'] = 'Lembre o funcionário de abrir a tela voltada para o cliente';

$lang['config_import_tax_classes_into_phppos'] = 'Importe Classes de Impostos para o %BRANDING_SHORT_NAME%';
$lang['config_export_tax_classes_into_phppos'] = 'Classes de imposto de exportação para comércio eletrônico';
$lang['config_import_shipping_classes_into_phppos'] = 'Importação de Classes de Embarque para o %BRANDING_SHORT_NAME%';
$lang['config_disable_confirm_recv'] = 'Desativar a confirmação para recebimento completo';
$lang['config_minimum_points_to_redeem'] = 'Número mínimo de pontos a resgatar';
$lang['config_default_days_to_expire_when_creating_items'] = 'Dias padrão para expirar ao criar itens';


$lang['config_quickbooks_settings'] = 'Configurações de Quickbooks';
$lang['config_qb_sync_operations'] = 'Operações de Sincronização de Quickbooks';
$lang['config_import_quickbooks_items_into_phppos'] = 'Importar itens para o %BRANDING_SHORT_NAME%';
$lang['config_export_phppos_items_to_quickbooks'] = 'Exportar itens para quickbooks';
$lang['config_import_customers_into_phppos'] = 'Importar clientes para o %BRANDING_SHORT_NAME%';
$lang['config_import_suppliers_into_phppos'] = 'Importar fornecedores para o %BRANDING_SHORT_NAME%';
$lang['config_import_employees_into_phppos'] = 'Importe funcionários para o %BRANDING_SHORT_NAME%';
$lang['config_export_employees_to_quickbooks'] = 'Exportar funcionários para quickbooks';
$lang['config_export_sales_to_quickbooks'] = 'Exportar vendas para quickbooks';
$lang['config_export_receivings_to_quickbooks'] = 'Exportar recebimentos para quickbooks';
$lang['config_export_customers_to_quickbooks'] = 'Exportar clientes para quickbooks';
$lang['config_export_suppliers_to_quickbooks'] = 'Exportar fornecedores para quickbooks';
$lang['config_connect_to_qb_online'] = 'Conecte-se a quickbooks online';
$lang['config_refresh_tokens'] = 'Atualizar tokens';
$lang['config_reconnect_quickbooks'] = 'Reconectar-se a quickbooks online';
$lang['config_reset_quickbooks'] = 'Redefinir Quickbooks';
$lang['config_qb_sync_logs'] = 'Logs de sincronização de Quickbooks';
$lang['config_quickbooks_progress'] = 'Progresso de sincronização dos Quickbooks';
$lang['config_last_qb_sync_date'] = 'Última data de sincronização';
$lang['config_confirmation_qb_cron_cancel'] = 'Tem certeza de que deseja cancelar a sincronização de livros rápidos?';
$lang['config_confirmation_qb_cron'] = 'Tem certeza de que deseja sincronizar os livros rápidos?';
$lang['config_confirm_reset_qb'] = 'Tem certeza de que deseja redefinir os quickbooks? Isto irá desvincular você dos quickbooks.';
$lang['config_reset_qb_successfully'] = 'Você redefiniu os quickbooks com sucesso';
$lang['config_export_phppos_categories_to_quickbooks'] = 'Exportar categorias de phppos para quickbooks';
$lang['config_create_payment_methods'] = 'Criar métodos de pagamento no QB';


$lang['config_allow_scan_of_customer_into_item_field'] = 'Permitir verificação do cliente no campo de item';
$lang['config_cash_alert_high'] = 'Alerta quando o dinheiro está acima';
$lang['config_cash_alert_low'] = 'Alerta quando o dinheiro está abaixo';


$lang['config_sync_inventory_changes_qb'] = 'Sincronizar alterações de inventário';

$lang['config_sort_receipt_column'] = 'Ordenar coluna de recibo';





$lang['config_show_tax_per_item_on_receipt'] = 'Mostrar imposto por item no recebimento';





$lang['config_enable_timeclock_pto'] = 'Ativar tempo de relógio pago fora';


$lang['config_enable_timeclock_pto'] = 'Ativar tempo de relógio pago fora';

$lang['config_show_item_id_on_recv_receipt'] = 'Mostrar ID do item ao receber';





$lang['config_import_all_past_orders_for_woo_commerce'] = 'Importar TODAS as encomendas anteriores para o WooCommerce';




$lang['config_enable_margin_calculator'] = 'Ativar calculadora de margem';










$lang['config_hide_barcode_on_barcode_labels'] = 'Ocultar código de barras nas etiquetas';



$lang['config_do_not_delete_saved_card_after_failure'] = 'NÃO apague o cartão salvo após falha';





$lang['config_capture_internal_notes_during_sale'] = 'Captura de notas internas durante a venda';





$lang['config_hide_prices_on_fill_sheet'] = 'Ocultar preços na folha de atendimento';



$lang['$platform=$this->Appconfig->get("ecommerce_platform");'] = 'if ($ platform == "woocommerce")';
$lang['config_default_revenue_account_for_item'] = 'Conta de receita padrão para itens';
$lang['config_default_asset_account_for_item'] = 'Conta de Ativo Padrão para Itens';
$lang['config_default_expense_account_for_item'] = 'Conta de Despesa Padrão Para Itens';
$lang['config_export_expenses_to_quickbooks'] = 'Despesas de exportação para quickbooks';
$lang['config_chart_of_accounts'] = 'Quickbooks Plano de contas';
$lang['config_keyword_chart_of_account'] = 'Quickbooks Plano de contas';
$lang['config_default_refund_cash_account_name'] = 'Conta em dinheiro de reembolso';
$lang['config_default_refund_credit_account_name'] = 'Conta de crédito de reembolso';
$lang['config_default_refund_debit_card_account_name'] = 'Conta de cartão de débito de reembolso';
$lang['config_default_refund_credit_card_account_name'] = 'Conta de cartão de crédito de reembolso';
$lang['config_default_refund_check_account_name'] = 'Conta de cheque de reembolso';
$lang['config_default_refund_deposit_account_name'] = 'Conta de depósito de reembolso';
$lang['config_default_expense_account_name'] = 'Conta de despesa';
$lang['config_default_expense_bank_credit_account_name'] = 'Banco de despesas / conta de crédito';
$lang['config_default_commission_credit_account_name'] = 'Conta de crédito da comissão';
$lang['config_default_commission_debit_account_name'] = 'Conta de débito da comissão';
$lang['config_default_house_account_name'] = 'Nome da conta da loja';
$lang['config_default_discount_item_name'] = 'Item de desconto';
$lang['config_default_house_item_name'] = 'Nome do item da casa';
$lang['config_default_store_account_item_name'] = 'Item da conta da loja';
$lang['config_default_house_account_category_name'] = 'Categoria de conta da casa';
$lang['config_default_customer_id'] = 'Nome Padrão do Cliente';
$lang['config_revenue_id'] = 'Falha ao salvar a configuração. Conta de receita padrão para itens está ausente.';
$lang['config_asset_id'] = 'Falha ao salvar a configuração. A conta de recurso padrão para itens está ausente';
$lang['config_export_confirm_box_text'] = 'Você quer exportar itens para quickbooks?';
$lang['config_discount_accounting_id'] = 'O ID de contabilização do item de desconto está em falta para venda';
$lang['config_sync_for_discount_accounting_id'] = 'Por favor, sincronizar itens antes de criar faturas com desconto';


$lang['config_hide_desc_emailed_receipts'] = 'Ocultar descrição em recibos enviados por e-mail';


$lang['config_default_tax'] = 'Imposto Predeterminado';
$lang['config_default_store_account_tax'] = 'Imposto da conta da loja padrão';
$lang['config_check_tax_name'] = 'O nome do imposto fornecido não está correto. Por favor, verifique o ID de venda:';
$lang['config_qb_start_sync_date'] = 'Iniciar data de sincronização';
$lang['config_default_tax_id'] = 'Imposto Predeterminado';
$lang['config_markup_markdown'] = 'Markup / Markdown';
$lang['config_show_total_discount_on_receipt'] = 'Mostrar desconto total no recebimento';
$lang['config_enable_pdf_receipts'] = 'Ativar recibos em PDF';
$lang['config_default_credit_limit'] = 'Limite de crédito padrão';

$lang['config_hide_expire_date_on_barcodes'] = 'Ocultar data de expiração em códigos de barras';

$lang['config_auto_capture_signature'] = 'Assinatura de captura automática';


$lang['config_pdf_receipt_message'] = 'Mensagem de recibo do PDF no corpo do email';

$lang['config_hide_merchant_id_from_receipt'] = 'Ocultar o ID do comerciante do recibo';


$lang['config_hide_all_prices_on_recv'] = 'Ocultar TODOS os preços no recebimento';
$lang['config_do_not_delete_serial_number_when_selling'] = 'NÃO apague o número de série quando vender';
$lang['config_webhooks'] = 'Web Hooks';
$lang['config_new_customer_web_hook'] = 'URL do novo Web Customer Hook';
$lang['config_new_sale_web_hook'] = 'URL do gancho da nova venda';
$lang['config_new_receiving_web_hook'] = 'Novo gancho da Web de recebimento';

$lang['config_strict_age_format_check'] = 'Verificação do formato de data restrita da verificação de idade';

$lang['config_flat_discounts_discount_tax'] = 'Desconto plano também desconta imposto';
$lang['config_show_item_kit_items_on_receipt'] = 'Exibir itens do kit de itens no recebimento';
$lang['config_amount_of_cash_to_be_left_in_drawer_at_closing'] = 'Quantidade de dinheiro a ser deixado na gaveta no fechamento';
$lang['config_hide_tier_on_receipt'] = 'Ocultar camada no recebimento';
$lang['config_second_language'] = 'Segundo idioma em recibos';
$lang['config_disable_gift_cards_sold_from_loyalty'] = 'Desative os vales-presente vendidos de ganhar lealdade';
$lang['config_track_shipping_cost_for_receivings'] = 'Acompanhe o custo de envio para recebimentos';
$lang['config_enable_points_for_giftcard_payments'] = 'Ativar pontos para pagamentos com cartão presente';




$lang['config_enable_tips'] = 'Ativar dicas';

$lang['config_support_regex'] = 'Suporta expressões regulares. Exemplo: 144. * corresponde a qualquer coisa que comece com 144';

$lang['config_not_all_processors_support_tips'] = 'Nem todos os processadores suportam o processamento de ponta integrado';
$lang['config_require_supplier_recv'] = 'Exigir fornecedor para receber';
$lang['config_default_payment_type_recv'] = 'Tipo de pagamento padrão para recebimentos';
$lang['config_taxjar_api_key'] = 'Chave da API TaxJar (somente nos EUA)';

$lang['config_quick_variation_grid'] = 'Ativar seleção rápida para variações na grade de itens';


$lang['config_quick_variation_grid'] = 'Seleção rápida para variações';


$lang['config_quick_variation_grid'] = 'Ativar seleção rápida na grade de itens para variações';



$lang['config_show_full_category_path'] = 'Mostrar caminho completo da categoria ao pesquisar';


$lang['config_do_not_upload_images_to_ecommerce'] = 'NÃO carregue imagens para o E-Commerce';

$lang['config_woo_enable_html_desc'] = 'Ativar HTML para descrições';

$lang['config_use_rtl_barcode_library'] = 'Use a biblioteca de códigos de barras RTL';
$lang['config_default_new_customer_to_current_location'] = 'Novo cliente padrão para a localização atual';
$lang['config_week_start_day'] = 'Dia de início da semana';
$lang['config_scan_and_set_sales'] = 'Escolher quantidade após adicionar item em vendas';
$lang['config_scan_and_set_recv'] = 'Escolher quantidade após adicionar item em recebimentos';
$lang['config_edit_sale_web_hook'] = 'Editar URL do Gancho da Web de venda';
$lang['config_edit_recv_web_hook'] = 'Editar URL do Gancho da Web de Recebimento';
$lang['config_hide_expire_dashboard'] = 'Ocultar itens expirados no painel';
$lang['config_hide_images_in_grid'] = 'Ocultar imagens na grade';
$lang['config_taxes_summary_on_receipt'] = 'Mostrar resumo tributável e não tributável no recebimento';
$lang['config_collapse_sales_ui_by_default'] = 'Recolher interface de vendas por padrão';
$lang['config_collapse_recv_ui_by_default'] = 'Recolher a Interface de recebimento por padrão';
$lang['config_enable_customer_quick_add'] = 'Ativar adição rápida do cliente';
$lang['config_uppercase_receipts'] = 'Texto em recibo em maiúsculas';

$lang['config_edit_customer_web_hook'] = 'Editar URL do gancho da Web do cliente';
$lang['config_show_selling_price_on_recv'] = 'Mostrar preço de venda ao receber recibo';

$lang['config_hide_email_on_receipts'] = 'Ocultar email no recebimento';



$lang['config_hide_available_giftcards'] = 'Ocultar cartões-presente disponíveis no registro de vendas';


$lang['config_enable_supplier_quick_add'] = 'Ativar adição rápida do fornecedor';
$lang['config_sync_inventory_from_location'] = 'Sincronizar inventário a partir da localização';
$lang['config_taxes_summary_details_on_receipt'] = 'Mostrar detalhes do imposto no recebimento';
$lang['config_disable_recv_number_on_barcode'] = 'Desativar número de recebimento no código de barras';
$lang['config_tax_jar_location'] = 'Use a API TaxJar Location para extrair impostos';
$lang['config_disable_loyalty_by_default'] = 'Desativar lealdade por padrão';

$lang['config_ecommerce_only_sync_completed_orders'] = 'Sincronizar apenas pedidos de comércio eletrônico concluídos';

$lang['config_damaged_reasons'] = 'Razões danificadas';

$lang['config_display_item_name_first_for_variation_name'] = 'Exibir o nome do item primeiro para variações nos códigos de barras';


$lang['config_do_not_allow_sales_with_zero_value'] = 'NÃO permita vendas com valor zero';

$lang['config_dont_recalculate_cost_price_when_unsuspending_estimates'] = 'Não recalcule o preço de custo quando estimativas não suspensas';


$lang['config_show_signature_on_receiving_receipt'] = 'Mostrar assinatura ao receber recibo';

$lang['config_do_not_treat_service_items_as_virtual'] = 'NÃO trate itens de serviço como produtos virtuais no comércio';

$lang['config_hide_latest_updates_in_header'] = 'Ocultar atualizações mais recentes no cabeçalho';
$lang['config_prompt_amount_for_cash_sale'] = 'Valor Prompt de Venda em Dinheiro';
$lang['config_do_not_allow_items_to_go_out_of_stock_when_transfering'] = 'Não permita que os itens fiquem fora de estoque durante a transferência';
$lang['config_show_tags_on_fulfillment_sheet'] = 'Mostrar tags de item na folha de preenchimento';
$lang['config_automatically_sms_receipt'] = 'Recibo de SMS automaticamente';
$lang['config_items_per_search_suggestions'] = 'Número de itens para sugestões de pesquisa';

$lang['config_shopify_settings_info'] = 'Configurações do Shopify';
$lang['config_shopify_shop'] = 'URL da loja Shopify';
$lang['config_connect_to_shopify'] = 'Conecte-se ao Shopify';
$lang['config_connect_to_shopify_reconnect'] = 'Reconectar para Shopify';
$lang['config_connected_to_shopify'] = 'Você está conectado ao Shopify';
$lang['config_disconnect_to_shopify'] = 'Desconectar-se do Shopify';

$lang['config_offline_mode'] = 'Ativar modo offline';
$lang['config_reset_offline_data'] = 'Redefinir dados offline';



$lang['config_remove_quantity_suspending'] = 'Remover quantidade ao suspender';
$lang['config_auto_sync_offline_sales'] = 'Vendas off-line de sincronização automática quando estiver on-line novamente';

$lang['config_shopify_billing_terms'] = 'Ative o faturamento - teste de 14 dias, depois US $ 19 por mês';
$lang['config_shopfiy_billing_failed'] = 'O faturamento do Shopify falhou';
$lang['config_cancel_shopify'] = 'Cancelar faturamento do Shopify';
$lang['config_confirm_cancel_shopify'] = 'Tem certeza que deseja cancelar o shopify?';
$lang['config_step_1'] = 'Passo 1';
$lang['config_step_2'] = 'Passo 2';
$lang['config_step_3'] = 'etapa 3';
$lang['config_step_4'] = 'Passo 4';
$lang['config_install_shopify_app'] = 'Instale o aplicativo Shopify';
$lang['config_connect_billing'] = 'Conectar faturamento';
$lang['config_choose_sync_options'] = 'Escolha as opções de sincronização';
$lang['config_ecommerce_sync_running'] = 'A sincronização de comércio eletrônico agora está sendo executada em segundo plano. Você pode verificar o status em Store Config.';
$lang['config_show_total_on_fulfillment'] = 'Mostrar Total na Folha de Cumprimento';
$lang['config_connect_shopify_in_app_store'] = 'Você não está conectado ao Shopify. Você pode se conectar ao Shopify na App Store';
$lang['config_override_signature_text'] = 'Substituir Texto de Assinatura';

$lang['config_delivery_color_based_on'] = 'Cor de entrega com base em';
$lang['config_delivery_color_based_on_status'] = 'Status';
$lang['config_delivery_color_based_on_category'] = 'Categoria';


$lang['config_update_cost_price_on_transfer'] = 'Atualizar preço de custo na transferência';



$lang['config_tip_preset_zero'] = 'Valor predefinido da ponta de 0%';



$lang['config_layaway_statement_message'] = 'Mensagem de declaração de viagem';


$lang['config_show_supplier_in_item_search_result'] = 'Mostrar fornecedor no resultado da pesquisa do item';


$lang['config_show_person_id_on_receipt'] = 'Mostrar identificação da pessoa no recibo';




$lang['config_import_ecommerce_orders_suspended'] = 'Pedidos de importação de comércio eletrônico suspensos';

$lang['config_show_images_on_receipt'] = 'Mostrar imagens no recibo';

$lang['config_disabled_fixed_discounts'] = 'Desativar descontos fixos inteiros na interface de vendas';



$lang['config_always_put_last_added_item_on_top_of_cart'] = 'Sempre coloque o último item adicionado no topo do carrinho';



$lang['config_show_giftcards_even_if_0_balance'] = 'Mostrar vales-presente mesmo com saldo zero';




$lang['config_scale_5'] = 'Código de barras incorporado de peso';



$lang['config_disable_modules'] = 'Desativar Módulos';

$lang['config_hide_description_on_suspended_sales'] = 'Ocultar descrição do item em vendas suspensas';
$lang['config_override_symbol_non_taxable'] = 'Símbolo de substituição para não tributável';



$lang['config_hide_categories_sales_grid'] = 'Ocultar categorias na grade de vendas';
$lang['config_hide_tags_sales_grid'] = 'Ocultar tags na grade de vendas';
$lang['config_hide_favorites_sales_grid'] = 'Ocultar favoritos na grade de vendas';
$lang['config_hide_categories_receivings_grid'] = 'Ocultar categorias na grade de recebimentos';
$lang['config_hide_tags_receivings_grid'] = 'Ocultar Marcas na Grade de Recebimentos';
$lang['config_hide_suppliers_receivings_grid'] = 'Ocultar fornecedores na grade de recebimentos';
$lang['config_hide_favorites_receivings_grid'] = 'Ocultar favoritos na grade de recebimentos';
$lang['config_hide_suppliers_sales_grid'] = 'Ocultar fornecedores na grade de vendas';

$lang['config_offline_mode_sync_period'] = 'Tempo do ciclo de sincronização do modo offline (horas)';



$lang['config_receipt_download_filename_prefix'] = 'Prefixo do nome do arquivo de download do recibo';
$lang['config_remove_employee_lastname_from_receipt'] = 'Remover o sobrenome do funcionário do recibo';


$lang['config_override_symbol_taxes_summary_on_receipt'] = 'SÍMBOLO DE SUBSTITUIÇÃO PARA MOSTRAR RESUMO TRIBUTÁVEL E NÃO TRIBUTÁVEL NO RECIBO';

$lang['config_show_images_on_receipt_width_percent'] = 'Largura máxima das imagens do item no recebimento (porcentagem)';




$lang['hide_supplier_in_item_search_result'] = 'Ocultar fornecedor no resultado da pesquisa do item';

$lang['config_link_to_receipt'] = 'Link para o recibo';
$lang['config_sale_summary_info'] = 'Informações de resumo de venda';
$lang['config_qr_code_format'] = 'Formato de código QR';

$lang['config_link_to_receipt'] = 'Link para o recibo';
$lang['config_sale_summary_info'] = 'Informações de resumo de venda';
$lang['config_qr_code_format'] = 'Formato de código QR';

$lang['config_override_symbol_taxable_summary'] = 'Símbolo de substituição para resumo tributável no recebimento';
$lang['config_override_symbol_non_taxable_summary'] = 'Símbolo de substituição para resumo não tributável no recebimento';
$lang['config_allow_drag_drop_recv'] = 'Permitir reordenar na tela de recebimento';
$lang['config_allow_drag_drop_sale'] = 'Permitir novo pedido na tela de venda';
$lang['config_disable_signature_capture_on_terminal_for_phppos_credit_card_processing'] = 'Desativar captura de assinatura para processamento de cartão de crédito %BRANDING_SHORT_NAME%';


$lang['config_capture_internal_notes_during_receiving'] = 'Captura de notas internas durante o recebimento';


$lang['config_default_employee_for_deliveries'] = 'Funcionário padrão para entregas';

$lang['config_disable_verification_for_qr_codes'] = 'Desative a verificação de códigos QR (não requer um número de telefone ou e-mail)';

$lang['config_disable_variation_popup_in_receivings'] = 'Desativar pop-up de variação no recebimento';

$lang['config_saudi_arabia_digital_receipt'] = 'Recibo Digital da Arábia Saudita';

$lang['config_scale_6'] = 'Peso Embedded Barcode EAN 13';

$lang['config_hide_location_name_on_receipt'] = 'Ocultar o nome do local no recebimento';
$lang['config_disable_discount_by_percentage'] = 'Desativar descontos inteiros por porcentagem na interface de vendas';

$lang['Delivery ID'] = 'ID de entrega';
$lang['config_scale_7'] = 'Códigos de barras incorporados de peso EAN 13 4 dígitos de preço';

$lang['config_use_main_image_as_default_image_in_e_commerce'] = 'Use a imagem principal como imagem padrão no comércio eletrônico';


$lang['config_disable_discounts_percentage_per_line_item'] = 'Desativar porcentagem de descontos por item de linha';

$lang['config_create_invoices_for_customer_store_account_charges'] = 'Criar faturas para cobranças da conta da loja do cliente';
$lang['config_create_invoices_for_supplier_store_account_charges'] = 'Criar faturas para cobranças da conta da loja do fornecedor';




$lang['config_turn_on_review_requests'] = 'Ativar solicitações de revisão';

$lang['config_additional_appointment_note'] = 'Nota de Nomeação Adicional';


$lang['config_hover_to_expand_sub_modules'] = 'Passe o mouse para expandir os submódulos';
$lang['common_parties'] = 'Festas';


$lang['config_send_sms_via_whatsapp'] = 'Enviar SMS pelo Whatsapp';

$lang['config_additional_appointment_note'] = 'Nota de Nomeação Adicional';

$lang['config_keywords_help_text'] = 'Aqui, você pode usar algumas palavras-chave.';

$lang['config_keywords_help_text'] = 'Aqui, você pode usar algumas palavras-chave.';





$lang['config_keyword_modules'] = 'Módulos';

$lang['config_allow_employees_to_use_2fa'] = 'Permitir que os funcionários usem 2FA (autenticação de dois fatores)';


$lang['shopify_private_key'] = 'Chave privada da Shopify';
$lang['shopify_public_key'] = 'Chave pública da Shopify';
$lang['config_reconnect_to_shopify'] = 'Reconecte-se à Shopify';


$lang['config_number_of_decimals_displayed_on_sales_interface'] = 'Número de decimais exibidos na interface de vendas';


$lang['shopify_private_key'] = 'Chave privada da Shopify';
$lang['shopify_public_key'] = 'Chave pública da Shopify';
$lang['config_reconnect_to_shopify'] = 'Reconecte-se à Shopify';




$lang['shopify_private_key'] = 'Chave privada da Shopify';
$lang['shopify_public_key'] = 'Chave pública da Shopify';
$lang['config_reconnect_to_shopify'] = 'Reconecte-se à Shopify';

$lang['config_keywords_help_text'] = 'Aqui, você pode usar algumas palavras-chave.';
$lang['config_easy_item_clone_button'] = 'Botão Clone de Item Fácil';

$lang['config_customer_allow_partial_match'] = 'Permitir correspondência parcial para pesquisa de clientes';

$lang['config_ig_api_bearer_token'] = 'Token de portador da API de gadgets lesionados';
$lang['config_ig_integration'] = 'Integração de gadgets feridos';
$lang['config_wgp_integration_pkey'] = 'Chave do parceiro de integração WGP';
$lang['config_lookup_api_integration'] = 'Integração da API de pesquisa';
$lang['config_wgp_integration_userid'] = 'ID de usuário de integração WGP';
$lang['config_work_order'] = 'Ordem de Serviço';
$lang['config_work_order_notes_internal'] = 'Notas internas por padrão';
$lang['config_enable_quick_customers'] = 'Ativar adição/atualização rápida do cliente';
$lang['config_enable_quick_suppliers'] = 'Ativar adição/atualização rápida de fornecedores';
$lang['config_enable_quick_items'] = 'Ativar adição/atualização rápida de itens';
$lang['config_enable_quick_expense'] = 'Ativar adição/atualização de despesas rápidas';
$lang['config_hide_supplier_on_sales_interface'] = 'Ocultar fornecedor na interface de vendas';
$lang['config_hide_supplier_on_recv_interface'] = 'Ocultar Fornecedor na Interface de Recebimento';
$lang['config_hide_supplier_from_item_popup'] = 'Ocultar fornecedor do pop-up de item';
$lang['config_enable_ig_integration'] = 'Ativar integração de gadgets danificados';
$lang['config_enable_wgp_integration'] = 'Ativar integração de peças de gadgets no atacado';


$lang['config_sso_info'] = 'Informações de logon único (SSO)';
$lang['config_sso_protocol'] = 'Protocolo SSO';
$lang['config_saml'] = 'SAML';
$lang['config_oidc'] = 'OIDC';
$lang['config_saml_idp_entity_id'] = 'ID da entidade do provedor de identidade (metadados)';
$lang['config_saml_single_sign_on_service'] = 'URL do serviço de logon único';
$lang['config_saml_single_logout_service'] = 'URL do serviço de logout único';
$lang['config_saml_x509_cert'] = 'Certificado x509';
$lang['saml_idp_entity_id'] = 'ID da entidade do provedor de identidade (metadados)';
$lang['config_saml_name_id_format'] = 'Formato de ID do nome Saml';
$lang['config_saml_first_name_field'] = 'Nome do campo de nome';
$lang['config_saml_last_name_field'] = 'Nome do campo sobrenome';
$lang['config_saml_email_field'] = 'Nome do campo de e-mail';
$lang['config_oidc_host'] = 'Anfitrião OIDC';
$lang['config_oidc_client_id'] = 'ID do cliente OIDC';
$lang['config_oidc_secret'] = 'Segredo OIDC';
$lang['config_oidc_cert_url'] = 'URL do certificado OIDC';
$lang['config_saml_groups_field'] = 'Nome do campo de grupos SAML';
$lang['config_oidc_groups_field'] = 'Campo Grupos OIDC';
$lang['config_oidc_additional_scopes'] = 'Escopos Adicionais do OIDC';
$lang['config_oidc_locations_field'] = 'Campo de locais do OIDC';
$lang['config_saml_locations_field'] = 'Campo de locais SAML';
$lang['config_oidc_username_field'] = 'Campo de nome de usuário OIDC';
$lang['config_add_ck_editor'] = 'Adicionar editor CK';
$lang['config_add_ck_editor'] = 'Usar o Editor HTML (Editor CK)';
$lang['config_do_not_allow_edit_of_overall_subtotal'] = 'Não permitir edição do subtotal geral';
$lang['config_only_allow_sso_logins'] = 'Permitir apenas logins SSO';
$lang['config_enable_p4_integration'] = 'Ativar integração Parts4Cells.com';
$lang['config_p4_api_bearer_token'] = 'Token de portador da API Parts4cells.com';
$lang['config_work_order_note_status'] = 'Status da Nota da Ordem de Serviço';
$lang['config_work_order_device_locations'] = 'Locais de dispositivos de ordens de serviço';




$lang['gmail_api_token_registered'] = 'O PHP Point Of Sale agora está autorizado a enviar e-mails em nome da sua conta do Gmail. Você pode fechar esta janela.';
$lang['gmail_api_token_removed'] = 'Seu token foi removido.';
$lang['gmail_api_authorize'] = 'Autorizar';
$lang['gmail_api_refresh'] = 'Atualizar';
$lang['gmail_api_remove'] = 'Remover';
$lang['gmail_api_error'] = 'Erro';
$lang['gmail_api_success'] = 'Sucesso';
$lang['gmail_api_authorize_require'] = 'Autorize a conta do Google.';


$lang['config_automatically_email_invoice'] = 'Fatura por e-mail automaticamente';



$lang['config_disable_default_value_for_tracking_number'] = 'Desativar valor padrão para número de rastreamento';
$lang['config_disable_supplier_selection_on_sales_interface'] = 'Desativar seleção de fornecedores na interface de vendas';

$lang['config_allow_reorder_sales_receipt'] = 'Permitir novo pedido no recibo de venda';
$lang['config_allow_reorder_receiving_receipt'] = 'Permitir novo pedido ao receber recibo';
$lang['config_only_allow_current_location_customers'] = 'Permitir apenas que os funcionários definam os clientes em sua localização';
$lang['config_only_allow_current_location_employees'] = 'Permitir apenas que os funcionários vejam o funcionário com localização';
$lang['config_use_sa_einvoice'] = 'Use a Fatura Eletrônica SA';
$lang['config_download_sdk_desc_fill_csr'] = 'Baixe e instale o SDK (Fatoora) para utilizar o sistema SA E-Invoicing. E preencha as entradas csr abaixo.';
$lang['config_saudi_tax_common_name_placeholder'] = 'Nome ou número de rastreamento de ativos para a unidade de solução';
$lang['config_saudi_tax_sn'] = 'Número de Série EGS';
$lang['config_saudi_tax_sn_placeholder'] = 'Nome do fabricante ou provedor de soluções, modelo ou versão e número de série';
$lang['config_saudi_tax_org_id'] = 'Identificador da organização';
$lang['config_saudi_tax_org_unit_name'] = 'Nome da unidade organizacional';
$lang['config_saudi_tax_org_name'] = 'Nome da organização';
$lang['config_saudi_tax_payer_name'] = 'Nome do Contribuinte';
$lang['config_saudi_tax_country_name'] = 'Nome do país';
$lang['config_saudi_tax_invoice_type_placeholder'] = 'Tipo de fatura, TSCZ, por exemplo: 1111';
$lang['config_saudi_tax_invoice_type'] = 'Tipo de Fatura';
$lang['config_saudi_tax_location_placeholder'] = 'Localização da filial ou dispositivo ou unidade de solução. Preferencialmente o %00Short Address%00 do Saudi National Address';
$lang['config_saudi_tax_industry'] = 'Indústria';
$lang['config_saudi_tax_industry_placeholder'] = 'Indústria ou localização';
$lang['config_saudi_tax_seller_id'] = 'ID do vendedor';
$lang['config_saudi_tax_seller_tax_id'] = 'ID do IVA do vendedor';
$lang['config_saudi_tax_seller_scheme_id'] = 'ID do esquema do vendedor';
$lang['config_saudi_tax_seller_scheme_id_select'] = 'Selecione o ID do esquema';
$lang['config_saudi_tax_postal_street_name'] = 'Nome da Rua Postal';
$lang['config_saudi_tax_postal_building_number'] = 'Número do Edifício Postal';
$lang['config_saudi_tax_postal_code'] = 'Código postal';
$lang['config_saudi_tax_postal_code_placeholder'] = 'Deve ter 5 dígitos.';
$lang['config_saudi_tax_postal_city_name'] = 'Nome da Cidade Postal';
$lang['config_saudi_tax_postal_district_name'] = 'Nome do Distrito Postal';
$lang['config_saudi_tax_postal_plot'] = 'Lote Postal';
$lang['config_saudi_tax_postal_country'] = 'País Postal';
$lang['config_saudi_tax_renew'] = 'Renovar';
$lang['config_saudi_tax_generate'] = 'Gerar';

$lang['config_hide_repair_items_in_sales_interface'] = 'Ocultar itens de reparo na interface de vendas';
$lang['config_hide_repair_items_on_receipt'] = 'Ocultar itens de reparo no recebimento';
$lang['config_disable_name_prefix'] = 'Desativar prefixo de nome';
$lang['config_update_base_cost_price_from_units'] = 'Atualizar custo base a partir de variações de quantidade unitária';


$lang['config_enable_name_prefix'] = 'Ativar prefixo de nome';


$lang['config_default_tech_is_logged_employee'] = 'O técnico padrão está conectado';
$lang['config_default_workorder_tech_is_logged_employee'] = 'O técnico de ordem de serviço padrão está conectado';

$lang['config_create_work_order_for_customer'] = 'Criar ordem de serviço para o cliente';


$lang['config_work_repair_item_taxable'] = 'Item de reparo tributável';

$lang['config_override_estimate_name'] = 'Nome da estimativa de substituição';
$lang['config_override_employee_label_on_receipt'] = 'Substituir etiqueta do funcionário no recebimento';
$lang['config_remove_weight_from_receipt'] = 'Remover peso do recibo';
$lang['config_show_item_description_service_tag'] = 'Mostrar etiqueta de serviço da descrição do item';
$lang['config_show_phone_number_service_tag'] = 'Mostrar etiqueta de serviço do número de telefone';
$lang['config_change_work_order_status_from_sales'] = 'Alterar o status da ordem de serviço de vendas';
$lang['config_work_order_change_status_on_sales_complete'] = 'Alterar status da ordem de serviço em vendas concluídas';
$lang['config_do_not_change'] = 'Não mude';
$lang['config_create_work_order_is_checked_by_default_for_sale'] = 'Criar ordem de serviço é verificado por padrão para venda';

$lang['config_remove_tax_percent_on_receipt'] = 'Remover percentual de imposto sobre o recebimento';







$lang['config_vidapay_info'] = 'Configurações do VIDPAY';
$lang['config_update_vidapay_catalog_for_existing_items'] = 'Atualizar Catálogo VIDAPAY para Itens Existentes';

$lang['config_work_order_warranty_checked_product_price_zero'] = 'Preço do produto zero se a garantia for verificada';



$lang['config_show_custom_fields_service_tag_work_orders'] = 'Mostrar campos personalizados na etiqueta de serviço';
$lang['config_show_custom_fields_label_service_tag_work_orders'] = 'Mostrar rótulo de campos personalizados na etiqueta de serviço';
$lang['config_show_estimated_repair_date_on_service_tag_work_orders'] = 'Mostrar data estimada de reparo na etiqueta de serviço';
$lang['config_change_to_recv_when_unsuspending_po'] = 'Alterar para o modo de recebimento ao cancelar a suspensão do pedido de compra';
$lang['config_scale_8'] = 'Código de barras embutido de peso EAN 13 4 dígitos de peso';
$lang['config_dont_show_images_in_search_suggestions'] = 'NÃO mostre imagens nas sugestões de pesquisa';


$lang['config_new_item_web_hook'] = 'Web Hook de Novo Item';
$lang['config_edit_item_web_hook'] = 'Editar Item Web Hook';
$lang['config_edit_work_order_web_hook'] = 'Editar Web Hook da Ordem de Serviço';
$lang['config_new_work_order_web_hook'] = 'Novo Web Hook de Ordem de Serviço';


$lang['config_work_orders_show_condensed_receipt'] = 'Mostrar recibo condensado para ordens de serviço';



$lang['config_square_terminal_get_id'] = 'Obtenha o código do dispositivo quadrado';
$lang['config_device_id'] = 'ID do dispositivo quadrado';

$lang['config_work_orders_show_condensed_receipt'] = 'Mostrar recibo condensado para ordens de serviço';

$lang['config_square_terminal_delete_id'] = 'Cancelar registro do terminal';

$lang['config_connect_to_woocommerce'] = 'Conecte-se ao Woocommerce';
$lang['config_woocommerce_oauth_set_alert'] = 'Estamos atualizando a sincronização do Woo Commerce para ser em tempo real. Para que o woo commerce continue funcionando, ele deve ser reiniciado. Clique abaixo para configurar.';

$lang['config_prompt_for_sale_id_on_return'] = 'Solicitar ID de venda na devolução';

$lang['delivery_url_https_error'] = 'O delivery_url não está usando HTTPS.';

$lang['config_do_not_allow_sales_with_zero_value_line_items'] = 'Não permitir itens de linha com valor zero';

$lang['config_return_reasons'] = 'Razões de devolução';
$lang['config_require_customer_for_return'] = 'Exigir que o cliente retorne';
$lang['config_require_receipt_for_return'] = 'Exigir recibo para devolução';


$lang['config_shopifycommerce_oauth_set_alert'] = 'Estamos atualizando a sincronização do Shopify para ser em tempo real. Para que o Shopify continue funcionando, ele deve ser reiniciado. Clique abaixo para configurar';

$lang['config_show_total_at_top_on_receipt'] = 'Mostrar total no topo do recibo';


$lang['config_ecommerce_realtime'] = 'Sincronização em tempo real';
$lang['config_dont_lock_suspended_sales'] = 'NÃO bloqueie vendas suspensas para evitar acesso duplicado';
$lang['config_show_exchanged_totals_on_receipt'] = 'Mostrar totais trocados no recebimento';
$lang['config_show_prices_on_work_orders'] = 'Mostrar preços na folha de ordem de serviço';
$lang['config_validate_location_id_of_customer_when_adding_to_sale'] = 'Valide a localização do cliente ao adicionar à venda';
$lang['config_use_tier_price_for_price_check'] = 'Use o nível para verificação de preço';
$lang['config_show_payments_on_work_order_sheet'] = 'Mostrar pagamentos na planilha de ordem de serviço';
?>