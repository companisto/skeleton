<?php

/*
 * This file is based on the original templating form helper from the symfony
 * framework bundle. Basically the same file but outside of the symfony
 * framework bundle.
 */

namespace ED\Symfony\FormsIntegration\Templating\Helper;

use Symfony\Component\Form\FormRendererInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Templating\Helper\Helper;

/**
 * FormHelper provides helpers to help display forms.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class FormHelper extends Helper
{
    private $renderer;

    public function __construct(FormRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'form';
    }

    /**
     * Sets a theme for a given view.
     *
     * The theme format is "<Bundle>:<Controller>".
     *
     * @param FormView     $view             A FormView instance
     * @param string|array $themes           A theme or an array of theme
     * @param bool         $useDefaultThemes If true, will use default themes defined in the renderer
     */
    public function setTheme(FormView $view, $themes, $useDefaultThemes = true)
    {
        $this->renderer->setTheme($view, $themes, $useDefaultThemes);
    }

    /**
     * Renders the HTML for a form.
     *
     * Example usage:
     *
     *     <?php echo view['form']->form($form) ?>
     *
     * You can pass options during the call:
     *
     *     <?php echo view['form']->form($form, ['attr' => ['class' => 'foo']]) ?>
     *
     *     <?php echo view['form']->form($form, ['separator' => '+++++']) ?>
     *
     * This method is mainly intended for prototyping purposes. If you want to
     * control the layout of a form in a more fine-grained manner, you are
     * advised to use the other helper methods for rendering the parts of the
     * form individually. You can also create a custom form theme to adapt
     * the look of the form.
     *
     * @param FormView $view      The view for which to render the form
     * @param array    $variables Additional variables passed to the template
     *
     * @return string The HTML markup
     */
    public function form(FormView $view, array $variables = [])
    {
        return $this->renderer->renderBlock($view, 'form', $variables);
    }

    /**
     * Renders the form start tag.
     *
     * Example usage templates:
     *
     *     <?php echo $view['form']->start($form) ?>>
     *
     * @param FormView $view      The view for which to render the start tag
     * @param array    $variables Additional variables passed to the template
     *
     * @return string The HTML markup
     */
    public function start(FormView $view, array $variables = [])
    {
        return $this->renderer->renderBlock($view, 'form_start', $variables);
    }

    /**
     * Renders the form end tag.
     *
     * Example usage templates:
     *
     *     <?php echo $view['form']->end($form) ?>>
     *
     * @param FormView $view      The view for which to render the end tag
     * @param array    $variables Additional variables passed to the template
     *
     * @return string The HTML markup
     */
    public function end(FormView $view, array $variables = [])
    {
        return $this->renderer->renderBlock($view, 'form_end', $variables);
    }

    /**
     * Renders the HTML for a given view.
     *
     * Example usage:
     *
     *     <?php echo $view['form']->widget($form) ?>
     *
     * You can pass options during the call:
     *
     *     <?php echo $view['form']->widget($form, ['attr' => ['class' => 'foo']]) ?>
     *
     *     <?php echo $view['form']->widget($form, ['separator' => '+++++']) ?>
     *
     * @param FormView $view      The view for which to render the widget
     * @param array    $variables Additional variables passed to the template
     *
     * @return string The HTML markup
     */
    public function widget(FormView $view, array $variables = [])
    {
        return $this->renderer->searchAndRenderBlock($view, 'widget', $variables);
    }

    /**
     * Renders the entire form field "row".
     *
     * @param FormView $view      The view for which to render the row
     * @param array    $variables Additional variables passed to the template
     *
     * @return string The HTML markup
     */
    public function row(FormView $view, array $variables = [])
    {
        return $this->renderer->searchAndRenderBlock($view, 'row', $variables);
    }

    /**
     * Renders the label of the given view.
     *
     * @param FormView $view      The view for which to render the label
     * @param string   $label     The label
     * @param array    $variables Additional variables passed to the template
     *
     * @return string The HTML markup
     */
    public function label(FormView $view, $label = null, array $variables = [])
    {
        if (null !== $label) {
            $variables += ['label' => $label];
        }

        return $this->renderer->searchAndRenderBlock($view, 'label', $variables);
    }

    /**
     * Renders the help of the given view.
     *
     * @param FormView $view The parent view
     *
     * @return string The HTML markup
     */
    public function help(FormView $view): string
    {
        return $this->renderer->searchAndRenderBlock($view, 'help');
    }

    /**
     * Renders the errors of the given view.
     *
     * @return string The HTML markup
     */
    public function errors(FormView $view)
    {
        return $this->renderer->searchAndRenderBlock($view, 'errors');
    }

    /**
     * Renders views which have not already been rendered.
     *
     * @param FormView $view      The parent view
     * @param array    $variables An array of variables
     *
     * @return string The HTML markup
     */
    public function rest(FormView $view, array $variables = [])
    {
        return $this->renderer->searchAndRenderBlock($view, 'rest', $variables);
    }

    /**
     * Renders a block of the template.
     *
     * @param FormView $view      The view for determining the used themes
     * @param string   $blockName The name of the block to render
     * @param array    $variables The variable to pass to the template
     *
     * @return string The HTML markup
     */
    public function block(FormView $view, $blockName, array $variables = [])
    {
        return $this->renderer->renderBlock($view, $blockName, $variables);
    }

    /**
     * Returns a CSRF token.
     *
     * Use this helper for CSRF protection without the overhead of creating a
     * form.
     *
     *     echo $view['form']->csrfToken('rm_user_'.$user->getId());
     *
     * Check the token in your action using the same CSRF token id.
     *
     *     // $csrfProvider being an instance of Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface
     *     if (!$csrfProvider->isCsrfTokenValid('rm_user_'.$user->getId(), $token)) {
     *         throw new \RuntimeException('CSRF attack detected.');
     *     }
     *
     * @param string $tokenId The CSRF token id of the protected action
     *
     * @return string A CSRF token
     *
     * @throws \BadMethodCallException when no CSRF provider was injected in the constructor
     */
    public function csrfToken($tokenId)
    {
        return $this->renderer->renderCsrfToken($tokenId);
    }

    public function humanize($text)
    {
        return $this->renderer->humanize($text);
    }

    /**
     * @internal
     */
    public function formEncodeCurrency($text, $widget = '')
    {
        if ('UTF-8' === $charset = $this->getCharset()) {
            $text = htmlspecialchars($text, ENT_QUOTES | (\defined('ENT_SUBSTITUTE') ? ENT_SUBSTITUTE : 0), 'UTF-8');
        } else {
            $text = htmlentities($text, ENT_QUOTES | (\defined('ENT_SUBSTITUTE') ? ENT_SUBSTITUTE : 0), 'UTF-8');
            $text = iconv('UTF-8', $charset, $text);
            $widget = iconv('UTF-8', $charset, $widget);
        }

        return str_replace('{{ widget }}', $widget, $text);
    }
}