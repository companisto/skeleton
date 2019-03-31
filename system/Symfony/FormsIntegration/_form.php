<?php
use Mainio\Symfony\FormsIntegration\TemplateNameParser;
use Mainio\Symfony\FormsIntegration\Templating\Helper\FormHelper;
use Mainio\Symfony\FormsIntegration\Templating\Helper\TranslatorHelper;
use Mainio\Symfony\FormsIntegration\Templating\Loader\FilesystemLoader;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Templating\TemplatingRendererEngine;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Validation;

$basedir = dirname(__DIR__);

require_once $basedir . '/vendor/autoload.php';

$loader = new FilesystemLoader(array());
$engine = new PhpEngine(new TemplateNameParser(), $loader);


$tre = new TemplatingRendererEngine($engine, array(
    $basedir . '/src/Resources/views/Form'
));
$renderer = new FormRenderer($tre);

// TODO: Set the translations within the concrete5 context
$translator = new Translator('en_US');

$formHelper = new FormHelper($renderer);
$translatorHelper = new TranslatorHelper($translator);

$engine->addHelpers(array($formHelper, $translatorHelper));

// Generate form view
$validator = Validation::createValidator();

$session = new Session();

$csrfGenerator = new \Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator();
$csrfStorage = new \Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage($session);
$csrfManager = new \Symfony\Component\Security\Csrf\CsrfTokenManager($csrfGenerator, $csrfStorage);

$factory = Forms::createFormFactoryBuilder()
    ->addExtension(new \Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension())
    ->addExtension(new \Symfony\Component\Form\Extension\Csrf\CsrfExtension($csrfManager))
    ->addExtension(new \Symfony\Component\Form\Extension\Validator\ValidatorExtension($validator))
    ->getFormFactory();

$builder = $factory->createBuilder(FormType::class, null, array('action' => '#'))
    ->add('name', TextType::class)
    ->add('submit', SubmitType::class, array('label' => 'Hello world!'));

$form = $builder->getForm();

// Render the form view
echo $renderer->renderBlock($form->createView(), 'form');

