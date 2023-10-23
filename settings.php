<?php

add_action('cmb2_admin_init', 'cfpd_register_options_metabox');

function cfpd_register_options_metabox()
{
    global $cfpd_pages_array, $cfpd_moeda;
    /**
     * Registers options page menu item and form.
     */
    $cmb_options = new_cmb2_box(array(
        'id'           => 'cfpd_option_metabox',
        'title'        => esc_html__('Opções Converte Fácil Post Data', 'cfpd'),
        'object_types' => array('options-page'),
        'option_key'      => 'cfpd_options', // The option key and admin menu page slug.
        'icon_url'        => 'dashicons-admin-generic', // Menu icon. Only applicable if 'parent_slug' is left empty.
        'menu_title'      => esc_html__('Converte Fácil Post Data', 'cfpd'), // Falls back to 'title' (above).
        'parent_slug'     => 'tools.php', // Make options page a submenu item of the themes menu.
        // 'capability'      => 'manage_options', // Cap required to view options-page.
        // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
        // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
        // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
        'save_button'     => false, // The text for the options-page save button. Defaults to 'Save'.
    ));

    $cmb_options->add_field(array(
        'name'    => __('Opções do Shortcode', 'cfpd'),
        'id'      => 'cfpd_login_page',
        'type'    => 'title',
        // 'before_row'   => 'yourprefix_before_row_if_2', // callback.
        'after_field'       => '
        <h3>Padrão</h3>
        <p>Retorna o <strong>título</strong> do post <strong>mais recente</strong>: <code>[cf-post-data]</code></p>

        <h3>Atributos</h3>
        
        <h4>Return</h4>

        <p>O atributo <code>return</code> serve para definir qual informação o shortocode irá retornar. O valor padrão do <code>return</code> é o <strong>título</strong> do post. As outras opções são:</p>
        <ul>
            <li><code>image</code>: retorna a URL da imagem destacada do post</li>
            <li><code>url</code>: retorna a URL do post</li>
            <li><code>cat</code>: retorna a categoria do post</li>
            <li><code>data</code>: retorna a data de publicação do post (mês, dia e ano)</li>
            <li><code>hora</code>: retorna a hora de publicação do post (h:m)</li>
            <li><code>author</code>: retorna o nome de exibição do autordo post (h:m)</li>
        </ul>

        <h4>Offset</h4>

        <p>O atributo <code>offset</code> serve para definir de qual post pegar as informações. O padrão é sempre o post <strong>mais recente</strong>. Para pegar as informações do <strong>penúltimo</strong> post mais recente, é necessário informar quantos posts serão pulados a partir do último post. Neste caso seria 1 post. Ficaria desta forma:</p>

        <p><code>[cf-post-data offset="1"]</code></p>
        
        <p>Para pegar as informações do <strong>terceiro</strong> (antepenúltimo) post mais recente, basta definir o valor do <code>offset</code> para <strong>2</strong> (ou seja, irá pular dois posts, o último e o penúltimo):</p>
        
        <p><code>[cf-post-data offset="2"]</code></p>

        <h3>Exemplos</h3>
        <p><code>[cf-post-data return="image"]</code> retorna a url da imagem destacada do <strong>último</strong> post (ex: "<i>https://seudominio.com.br/wp-content/uploads/2023/01/nome-do-arquivo.png</i>")</p>
        <p><code>[cf-post-data return="data" offset="5"]</code> retorna a data (mês, dia e ano) do <strong>sexto</strong> post mais recente (ex:"<i>Fevereiro 19, 2021</i>")</p>

        ',
        'after_row'    => '<style>p.submit{display:none;}</style>',// esconde o botão de salvar, uma vez que não há nada a ser salvo

    ));
}

function cfpd_get_option($key = '', $default = false)
{
    if (function_exists('cmb2_get_option')) {
        // Use cmb2_get_option as it passes through some key filters.
        return cmb2_get_option('cfpd_options', $key, $default);
    }

    // Fallback to get_option if CMB2 is not loaded yet.
    $opts = get_option('cfpd_options', $default);

    $val = $default;

    if ('all' == $key) {
        $val = $opts;
    } elseif (is_array($opts) && array_key_exists($key, $opts) && false !== $opts[$key]) {
        $val = $opts[$key];
    }

    return $val;
}
