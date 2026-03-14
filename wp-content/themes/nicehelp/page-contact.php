<?php
/**
 * Template Name: Contact Page
 *
 * Contact / Submit Ticket Page
 *
 * @package NiceHelp
 */

get_header();
?>

<!-- Contact Hero -->
<section class="nh-contact-hero">
    <div class="nh-contact-hero__inner">
        <div class="nh-contact-hero__icon-wrap">
            <i data-lucide="mail"></i>
        </div>
        <h1 class="nh-contact-hero__title"><?php esc_html_e('联系支持', 'nicehelp'); ?></h1>
        <p class="nh-contact-hero__desc">
            <?php esc_html_e('找不到您需要的答案？我们的支持团队随时为您提供帮助。填写以下表单，我们将在 24 小时内回复您。', 'nicehelp'); ?>
        </p>
    </div>
</section>

<!-- Main Area -->
<div class="nh-contact-layout">
    <div class="nh-contact-layout__inner">
        <!-- Form -->
        <div class="nh-contact-form">
            <h2 class="nh-contact-form__title"><?php esc_html_e('提交支持工单', 'nicehelp'); ?></h2>
            <p class="nh-contact-form__desc"><?php esc_html_e('请尽可能详细地描述您的问题，以便我们快速为您提供帮助。', 'nicehelp'); ?></p>

            <form method="post" enctype="multipart/form-data" class="nh-contact-form__form">
                <?php wp_nonce_field('nicehelp_contact', 'nicehelp_contact_nonce'); ?>

                <div class="nh-form-field">
                    <label for="nh-name" class="nh-form-label"><?php esc_html_e('姓名 *', 'nicehelp'); ?></label>
                    <input type="text" id="nh-name" name="nh_name" class="nh-form-input" required
                           placeholder="<?php esc_attr_e('请输入您的姓名', 'nicehelp'); ?>" />
                </div>

                <div class="nh-form-field">
                    <label for="nh-email" class="nh-form-label"><?php esc_html_e('邮箱地址 *', 'nicehelp'); ?></label>
                    <input type="email" id="nh-email" name="nh_email" class="nh-form-input" required
                           placeholder="<?php esc_attr_e('you@example.com', 'nicehelp'); ?>" />
                </div>

                <div class="nh-form-field">
                    <label for="nh-subject" class="nh-form-label"><?php esc_html_e('主题 *', 'nicehelp'); ?></label>
                    <input type="text" id="nh-subject" name="nh_subject" class="nh-form-input" required
                           placeholder="<?php esc_attr_e('简要描述您的问题', 'nicehelp'); ?>" />
                </div>
                <div class="nh-form-field">
                    <label for="nh-category" class="nh-form-label"><?php esc_html_e('分类 *', 'nicehelp'); ?></label>
                    <select id="nh-category" name="nh_category" class="nh-form-select" required>
                        <option value=""><?php esc_html_e('请选择分类', 'nicehelp'); ?></option>
                        <option value="general"><?php esc_html_e('一般问题', 'nicehelp'); ?></option>
                        <option value="technical"><?php esc_html_e('技术问题', 'nicehelp'); ?></option>
                        <option value="billing"><?php esc_html_e('账单与支付', 'nicehelp'); ?></option>
                        <option value="feature"><?php esc_html_e('功能建议', 'nicehelp'); ?></option>
                        <option value="bug"><?php esc_html_e('错误报告', 'nicehelp'); ?></option>
                    </select>
                </div>

                <div class="nh-form-field">
                    <label for="nh-message" class="nh-form-label"><?php esc_html_e('详细描述 *', 'nicehelp'); ?></label>
                    <textarea id="nh-message" name="nh_message" class="nh-form-textarea" rows="6" required
                              placeholder="<?php esc_attr_e('请详细描述您的问题...', 'nicehelp'); ?>"></textarea>
                </div>

                <div class="nh-form-field">
                    <label class="nh-form-label"><?php esc_html_e('附件（可选）', 'nicehelp'); ?></label>
                    <div class="nh-form-upload">
                        <i data-lucide="upload-cloud"></i>
                        <p><?php esc_html_e('拖拽文件到此处，或点击浏览', 'nicehelp'); ?></p>
                        <span><?php esc_html_e('PNG、JPG、PDF，最大 10MB', 'nicehelp'); ?></span>
                        <input type="file" name="nh_attachment" accept=".png,.jpg,.jpeg,.pdf" />
                    </div>
                </div>

                <button type="submit" class="nh-btn nh-btn--primary nh-btn--lg nh-btn--full">
                    <?php esc_html_e('提交工单', 'nicehelp'); ?>
                </button>
            </form>
        </div>

        <!-- Contact Sidebar -->
        <aside class="nh-contact-sidebar">
            <div class="nh-contact-card">
                <div class="nh-contact-card__icon" style="background-color: #EFF6FF">
                    <i data-lucide="message-circle" style="color: #2563EB"></i>
                </div>
                <h3 class="nh-contact-card__title"><?php esc_html_e('在线聊天', 'nicehelp'); ?></h3>
                <p class="nh-contact-card__desc"><?php esc_html_e('与我们的支持团队实时聊天。平均响应时间：2 分钟。', 'nicehelp'); ?></p>
                <div class="nh-contact-card__status">
                    <span class="nh-contact-card__dot nh-contact-card__dot--online"></span>
                    <span><?php esc_html_e('当前在线', 'nicehelp'); ?></span>
                </div>
                <a href="#" class="nh-btn nh-btn--primary nh-btn--full"><?php esc_html_e('开始聊天', 'nicehelp'); ?></a>
            </div>

            <div class="nh-contact-card">
                <div class="nh-contact-card__icon" style="background-color: #F0FDF4">
                    <i data-lucide="mail" style="color: #16A34A"></i>
                </div>
                <h3 class="nh-contact-card__title"><?php esc_html_e('邮件支持', 'nicehelp'); ?></h3>
                <p class="nh-contact-card__desc"><?php esc_html_e('发送邮件给我们，我们将在工作日 24 小时内回复。', 'nicehelp'); ?></p>
                <a href="mailto:support@cengku.com" class="nh-link">support@cengku.com</a>
            </div>

            <div class="nh-contact-card">
                <div class="nh-contact-card__icon" style="background-color: #FFF7ED">
                    <i data-lucide="phone" style="color: #EA580C"></i>
                </div>
                <h3 class="nh-contact-card__title"><?php esc_html_e('电话支持', 'nicehelp'); ?></h3>
                <p class="nh-contact-card__desc"><?php esc_html_e('紧急问题请致电。服务时间：周一至周五 9:00-18:00（北京时间）。', 'nicehelp'); ?></p>
                <a href="tel:+864001234567" class="nh-link">+86 400-123-4567</a>
            </div>
        </aside>
    </div>
</div>

<?php get_footer(); ?>