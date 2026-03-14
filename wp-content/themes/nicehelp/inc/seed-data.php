<?php
/**
 * Theme Demo Data Seeder
 *
 * Populates the database with initial categories, articles, posts, pages and menus.
 * Runs once on theme activation. Can be re-triggered via admin: 外观 → 初始化数据.
 *
 * @package NiceHelp
 */

defined('ABSPATH') || exit;

/**
 * Main seeder — called on theme activation or manual trigger.
 */
function nicehelp_seed_data(): void {
    if (get_option('nicehelp_seeded')) {
        return;
    }

    nicehelp_seed_categories();
    nicehelp_seed_help_articles();
    nicehelp_seed_posts();
    nicehelp_seed_pages();
    nicehelp_seed_menus();

    // Set reading settings: static front page
    $front = get_page_by_path('help-home');
    if ($front) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front->ID);
    }

    update_option('nicehelp_seeded', true);
    flush_rewrite_rules();
}

// --- Categories -----------------------------------------------------------

function nicehelp_seed_categories(): void {
    $cats = [
        ['name' => '快速入门', 'slug' => 'getting-started', 'desc' => '快速设置指南、入门步骤和新用户必备配置。', 'icon' => 'rocket',    'color' => '#2563EB', 'bg' => '#EFF6FF'],
        ['name' => '账户与设置', 'slug' => 'account-settings', 'desc' => '管理您的个人资料、偏好设置、账单和团队设置。', 'icon' => 'settings',  'color' => '#16A34A', 'bg' => '#F0FDF4'],
        ['name' => '集成',       'slug' => 'integrations',     'desc' => '连接第三方工具、API、Webhook 和自动化工作流。', 'icon' => 'puzzle',    'color' => '#D97706', 'bg' => '#FEF3C7'],
        ['name' => '安全与隐私', 'slug' => 'security-privacy', 'desc' => '双重认证、数据加密、访问控制和合规功能。',       'icon' => 'shield',    'color' => '#DB2777', 'bg' => '#FDF2F8'],
        ['name' => '教程与指南', 'slug' => 'tutorials',        'desc' => '分步教程、视频教程和最佳实践指南。',             'icon' => 'book-open', 'color' => '#7C3AED', 'bg' => '#F5F3FF'],
        ['name' => '故障排除',   'slug' => 'troubleshooting',  'desc' => '常见问题、错误信息、调试技巧和快速解决方案。',   'icon' => 'wrench',    'color' => '#EA580C', 'bg' => '#FFF7ED'],
    ];

    foreach ($cats as $c) {
        if (term_exists($c['slug'], 'help_category')) {
            continue;
        }
        $result = wp_insert_term($c['name'], 'help_category', [
            'slug'        => $c['slug'],
            'description' => $c['desc'],
        ]);
        if (!is_wp_error($result)) {
            $tid = $result['term_id'];
            update_term_meta($tid, 'nicehelp_cat_icon',  $c['icon']);
            update_term_meta($tid, 'nicehelp_cat_color', $c['color']);
            update_term_meta($tid, 'nicehelp_cat_bg',    $c['bg']);
        }
    }
}

// --- Help Articles --------------------------------------------------------

function nicehelp_seed_help_articles(): void {
    $articles = [
        // 快速入门
        ['title' => '如何创建您的第一个账户',   'cat' => 'getting-started', 'content' => nicehelp_article_body('本指南将带您完成账户注册的每一步。', '注册流程', "1. 访问官网首页，点击右上角「注册」按钮。\n2. 填写邮箱地址和密码。\n3. 查收验证邮件并点击确认链接。\n4. 完善个人资料信息。\n5. 选择适合您的订阅计划。")],
        ['title' => '5 分钟快速上手指南',       'cat' => 'getting-started', 'content' => nicehelp_article_body('从零开始，5 分钟内掌握核心功能。', '核心步骤', "1. 创建您的工作区。\n2. 邀请团队成员加入。\n3. 创建第一个项目。\n4. 配置基础集成。\n5. 开始使用仪表盘。")],

        // 账户与设置
        ['title' => '如何修改个人资料和头像',   'cat' => 'account-settings', 'content' => nicehelp_article_body('更新您的显示名称、头像和联系方式。', '修改步骤', "1. 进入「设置」→「个人资料」。\n2. 点击头像区域上传新图片。\n3. 修改显示名称和简介。\n4. 点击「保存更改」。")],
        ['title' => '管理团队成员与权限',       'cat' => 'account-settings', 'content' => nicehelp_article_body('了解如何添加、移除团队成员并分配角色。', '权限说明', "- **管理员**：拥有所有权限，可管理账单和团队。\n- **编辑者**：可创建和编辑所有内容。\n- **成员**：可查看和编辑自己的内容。\n- **访客**：仅可查看公开内容。")],

        // 集成
        ['title' => '连接您的第一个 API 集成',  'cat' => 'integrations', 'content' => nicehelp_article_body('通过 API 将外部服务与平台连接。', '集成步骤', "1. 进入「设置」→「集成」→「添加新集成」。\n2. 选择目标服务（如 Slack、GitHub）。\n3. 授权访问权限。\n4. 配置数据同步规则。\n5. 测试连接并保存。")],
        ['title' => 'Webhook 配置完整指南',     'cat' => 'integrations', 'content' => nicehelp_article_body('使用 Webhook 实现实时事件通知。', '配置方法', "1. 进入「设置」→「Webhook」。\n2. 点击「新建 Webhook」。\n3. 填写回调 URL。\n4. 选择要监听的事件类型。\n5. 保存并发送测试请求。")],

        // 安全与隐私
        ['title' => '启用双重认证（2FA）',      'cat' => 'security-privacy', 'content' => nicehelp_article_body('为您的账户添加额外的安全保护层。', '启用步骤', "1. 进入「设置」→「安全」→「双重认证」。\n2. 选择认证方式（短信或认证器应用）。\n3. 扫描二维码或输入手机号。\n4. 输入验证码完成绑定。\n5. 保存恢复代码到安全位置。")],
        ['title' => '数据加密与隐私保护说明',   'cat' => 'security-privacy', 'content' => nicehelp_article_body('了解我们如何保护您的数据安全。', '安全措施', "- 所有数据传输使用 TLS 1.3 加密。\n- 静态数据使用 AES-256 加密存储。\n- 定期进行第三方安全审计。\n- 符合 GDPR 和 SOC 2 合规要求。")],

        // 教程与指南
        ['title' => '从零搭建自动化工作流',     'cat' => 'tutorials', 'content' => nicehelp_article_body('学习如何创建自动化规则来提升效率。', '创建流程', "1. 进入「自动化」→「新建工作流」。\n2. 选择触发条件（如新任务创建）。\n3. 添加执行动作（如发送通知）。\n4. 设置过滤条件。\n5. 启用工作流并监控运行状态。")],
        ['title' => '高级报表与数据分析教程',   'cat' => 'tutorials', 'content' => nicehelp_article_body('掌握数据分析工具，生成专业报表。', '报表功能', "- **仪表盘**：自定义数据面板，实时监控关键指标。\n- **导出**：支持 CSV、PDF、Excel 格式。\n- **定时报告**：设置自动发送周报/月报。\n- **数据筛选**：按时间、团队、项目多维度分析。")],

        // 故障排除
        ['title' => '常见登录问题及解决方案',   'cat' => 'troubleshooting', 'content' => nicehelp_article_body('遇到登录问题？这里有最常见的解决方法。', '常见问题', "**忘记密码**\n点击登录页「忘记密码」，通过邮箱重置。\n\n**账户被锁定**\n连续 5 次输错密码后账户会被锁定 30 分钟，请稍后重试。\n\n**双重认证失败**\n确认手机时间同步正确，或使用恢复代码登录。")],
        ['title' => '页面加载缓慢的排查方法',   'cat' => 'troubleshooting', 'content' => nicehelp_article_body('诊断和解决页面加载性能问题。', '排查步骤', "1. 清除浏览器缓存和 Cookie。\n2. 检查网络连接是否稳定。\n3. 禁用浏览器扩展逐一排查。\n4. 尝试使用无痕模式访问。\n5. 如问题持续，请联系技术支持。")],
    ];

    foreach ($articles as $a) {
        if (get_page_by_title($a['title'], OBJECT, 'help_article')) {
            continue;
        }
        $pid = wp_insert_post([
            'post_title'   => $a['title'],
            'post_content' => $a['content'],
            'post_status'  => 'publish',
            'post_type'    => 'help_article',
            'post_excerpt' => mb_substr(wp_strip_all_tags($a['content']), 0, 120),
        ]);
        if ($pid && !is_wp_error($pid)) {
            $term = get_term_by('slug', $a['cat'], 'help_category');
            if ($term) {
                wp_set_object_terms($pid, $term->term_id, 'help_category');
            }
            update_post_meta($pid, '_nicehelp_views', wp_rand(50, 500));
        }
    }
}

/** Helper: generate structured article body */
function nicehelp_article_body(string $intro, string $heading, string $body): string {
    return "<p>{$intro}</p>\n\n<h2>{$heading}</h2>\n\n{$body}";
}

// --- Blog Posts (日志) ----------------------------------------------------

function nicehelp_seed_posts(): void {
    $posts = [
        [
            'title'   => '2026 年 2 月产品更新日志',
            'cat'     => '产品更新',
            'content' => "<p>本月我们带来了多项重要更新，提升了平台的稳定性和用户体验。</p>\n\n<h2>新功能</h2>\n\n- 全新仪表盘设计，数据一目了然。\n- 支持批量导入/导出数据。\n- 新增 5 种报表模板。\n\n<h2>改进</h2>\n\n- 页面加载速度提升 40%。\n- 搜索结果准确度优化。\n- 移动端适配改进。\n\n<h2>修复</h2>\n\n- 修复了部分用户无法上传附件的问题。\n- 修复了通知邮件偶尔延迟的问题。",
        ],
        [
            'title'   => '新功能上线：团队协作工作区',
            'cat'     => '产品更新',
            'content' => "<p>我们很高兴地宣布，全新的团队协作工作区功能正式上线！</p>\n\n<h2>功能亮点</h2>\n\n- **实时协作**：多人同时编辑同一文档，所见即所得。\n- **评论与批注**：在任意位置添加评论，@提及团队成员。\n- **版本历史**：自动保存所有修改记录，随时回溯。\n- **权限管理**：精细化的文档访问权限控制。",
        ],
        [
            'title'   => '系统维护通知：2026 年 3 月 1 日',
            'cat'     => '系统公告',
            'content' => "<p>为了提供更好的服务，我们将于 2026 年 3 月 1 日进行系统维护。</p>\n\n<h2>维护详情</h2>\n\n- **时间**：2026 年 3 月 1 日 02:00 - 06:00（北京时间）\n- **影响**：维护期间平台将暂时无法访问。\n- **内容**：数据库升级、安全补丁更新、性能优化。\n\n<p>我们建议您提前保存工作内容。维护完成后服务将自动恢复。</p>",
        ],
        [
            'title'   => '2026 年 1 月产品更新日志',
            'cat'     => '产品更新',
            'content' => "<p>新年第一个月，我们专注于基础设施升级和安全增强。</p>\n\n<h2>安全增强</h2>\n\n- 升级至 TLS 1.3 加密协议。\n- 新增登录设备管理功能。\n- 支持硬件安全密钥（FIDO2）。\n\n<h2>性能优化</h2>\n\n- API 响应时间降低 30%。\n- 文件上传支持断点续传。\n- 优化大数据量列表渲染。",
        ],
        [
            'title'   => '帮助中心全新改版上线',
            'cat'     => '系统公告',
            'content' => "<p>我们对帮助中心进行了全面改版，为您带来更好的自助服务体验。</p>\n\n<h2>改版亮点</h2>\n\n- **全新设计**：更清晰的分类导航，快速找到所需内容。\n- **智能搜索**：支持关键词联想和模糊匹配。\n- **分步教程**：图文并茂的操作指南。\n- **常见问题**：精选高频问题，一键获取答案。\n\n<p>欢迎体验新版帮助中心，如有建议请随时反馈！</p>",
        ],
    ];

    // Ensure blog categories exist
    $blog_cats = ['产品更新', '系统公告'];
    foreach ($blog_cats as $cat_name) {
        if (!term_exists($cat_name, 'category')) {
            wp_insert_term($cat_name, 'category');
        }
    }

    foreach ($posts as $p) {
        if (get_page_by_title($p['title'], OBJECT, 'post')) {
            continue;
        }
        $pid = wp_insert_post([
            'post_title'   => $p['title'],
            'post_content' => $p['content'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_excerpt' => mb_substr(wp_strip_all_tags($p['content']), 0, 120),
        ]);
        if ($pid && !is_wp_error($pid)) {
            $term = get_term_by('name', $p['cat'], 'category');
            if ($term) {
                wp_set_object_terms($pid, $term->term_id, 'category');
            }
        }
    }
}

// --- Pages ----------------------------------------------------------------

function nicehelp_seed_pages(): void {
    $pages = [
        [
            'title'    => '帮助中心',
            'slug'     => 'help-home',
            'content'  => '',
            'template' => '',
        ],
        [
            'title'    => '联系我们',
            'slug'     => 'contact',
            'content'  => '',
            'template' => 'page-contact.php',
        ],
    ];

    foreach ($pages as $p) {
        if (get_page_by_path($p['slug'])) {
            continue;
        }
        $pid = wp_insert_post([
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_content' => $p['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
        if ($pid && !is_wp_error($pid) && $p['template']) {
            update_post_meta($pid, '_wp_page_template', $p['template']);
        }
    }
}

// --- Navigation Menus -----------------------------------------------------

function nicehelp_seed_menus(): void {
    // Primary menu
    $primary_id = nicehelp_create_menu('主导航', 'primary', [
        ['title' => '首页',     'url' => home_url('/')],
        ['title' => '文档',     'url' => get_post_type_archive_link('help_article') ?: home_url('/help/')],
        ['title' => '指南',     'url' => home_url('/?help_category=tutorials')],
        ['title' => 'API 参考', 'url' => home_url('/?help_category=integrations')],
        ['title' => '社区',     'url' => '#'],
    ]);

    // Footer menus
    nicehelp_create_menu('产品', 'footer-product', [
        ['title' => '文档',     'url' => get_post_type_archive_link('help_article') ?: home_url('/help/')],
        ['title' => 'API 参考', 'url' => home_url('/?help_category=integrations')],
        ['title' => '更新日志', 'url' => home_url('/?cat=' . (get_cat_ID('产品更新') ?: ''))],
        ['title' => '状态',     'url' => '#'],
    ]);

    nicehelp_create_menu('资源', 'footer-resources', [
        ['title' => '博客',     'url' => home_url('/blog/')],
        ['title' => '社区',     'url' => '#'],
        ['title' => '教程',     'url' => home_url('/?help_category=tutorials')],
        ['title' => '网络研讨会', 'url' => '#'],
    ]);

    nicehelp_create_menu('公司', 'footer-company', [
        ['title' => '关于我们', 'url' => '#'],
        ['title' => '招聘',     'url' => '#'],
        ['title' => '隐私政策', 'url' => '#'],
        ['title' => '服务条款', 'url' => '#'],
    ]);
}

/** Helper: create a nav menu and assign to a location */
function nicehelp_create_menu(string $name, string $location, array $items): int {
    $existing = wp_get_nav_menu_object($name);
    if ($existing) {
        return $existing->term_id;
    }

    $menu_id = wp_create_nav_menu($name);
    if (is_wp_error($menu_id)) {
        return 0;
    }

    foreach ($items as $item) {
        wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title'  => $item['title'],
            'menu-item-url'    => $item['url'],
            'menu-item-status' => 'publish',
            'menu-item-type'   => 'custom',
        ]);
    }

    $locations = get_theme_mod('nav_menu_locations', []);
    $locations[$location] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    return $menu_id;
}

// --- Admin page to re-run seeder -----------------------------------------

add_action('admin_menu', function () {
    add_submenu_page(
        'themes.php',
        '初始化演示数据',
        '初始化数据',
        'manage_options',
        'nicehelp-seed',
        'nicehelp_seed_admin_page'
    );
});

function nicehelp_seed_admin_page(): void {
    if (isset($_POST['nicehelp_reseed']) && check_admin_referer('nicehelp_reseed')) {
        delete_option('nicehelp_seeded');
        nicehelp_seed_data();
        echo '<div class="notice notice-success"><p>演示数据初始化完成！</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>NiceHelp 数据初始化</h1>
        <p>点击下方按钮初始化演示数据（分类、帮助文章、日志、页面和导航菜单）。</p>
        <p><strong>注意：</strong>已存在的同名内容不会重复创建。</p>
        <form method="post">
            <?php wp_nonce_field('nicehelp_reseed'); ?>
            <input type="hidden" name="nicehelp_reseed" value="1" />
            <?php submit_button('初始化演示数据', 'primary', 'submit', false); ?>
        </form>
    </div>
    <?php
}

// Run on theme activation
add_action('after_switch_theme', 'nicehelp_seed_data');
