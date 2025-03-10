<?php

namespace Payum\Core\Bridge\Symfony\Form\Type;

use Payum\Core\Model\GatewayConfig;
use Payum\Core\Registry\GatewayFactoryRegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

@trigger_error('The ' . __NAMESPACE__ . '\GatewayConfigType class is deprecated since version 2.0 and will be removed in 3.0. Use the same class from Payum/PayumBundle instead.', E_USER_DEPRECATED);

/**
 * @deprecated since 2.0. Use the same class from Payum/PayumBundle instead.
 */
class GatewayConfigType extends AbstractType
{
    private GatewayFactoryRegistryInterface $registry;

    public function __construct(GatewayFactoryRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gatewayName')
            ->add('factoryName', GatewayFactoriesChoiceType::class)
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'buildCredentials']);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'buildCredentials']);
    }

    public function buildCredentials(FormEvent $event): void
    {
        /** @var array $data */
        $data = $event->getData();
        if (is_null($data)) {
            return;
        }

        $propertyPath = is_array($data) ? '[factoryName]' : 'factoryName';
        $factoryName = PropertyAccess::createPropertyAccessor()->getValue($data, $propertyPath);
        if (empty($factoryName)) {
            return;
        }

        $form = $event->getForm();

        $form->add('config', FormType::class);
        $configForm = $form->get('config');

        $gatewayFactory = $this->registry->getGatewayFactory($factoryName);
        $config = $gatewayFactory->createConfig();
        $propertyPath = is_array($data) ? '[config]' : 'config';
        $firstTime = ! PropertyAccess::createPropertyAccessor()->getValue($data, $propertyPath);
        foreach ($config['payum.default_options'] as $name => $value) {
            $propertyPath = is_array($data) ? "[config][{$name}]" : "config[{$name}]";
            if ($firstTime) {
                PropertyAccess::createPropertyAccessor()->setValue($data, $propertyPath, $value);
            }

            $type = is_bool($value) ? CheckboxType::class : TextType::class;

            $options = [];
            $options['required'] = in_array($name, $config['payum.required_options']);

            $configForm->add($name, $type, $options);
        }

        $event->setData($data);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GatewayConfig::class,
        ]);
    }
}
