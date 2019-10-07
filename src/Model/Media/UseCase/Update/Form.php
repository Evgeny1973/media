<?php

namespace App\Model\Media\UseCase\Update;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Command::class,
		]);
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('companyName', TextType::class, [
				'label' => 'Компания',
			])
			->add('mediaName', TextType::class, [
				'label' => 'Издание',
			])
			->add('publishingDate', DateType::class, [
				'label'  => 'Дата публикации',
				'widget' => 'single_text',
				'html5'  => false,
				'attr'   => ['class' => 'js-datepicker', 'autocomplete' => 'off'],
			])
			->add('budget', TextType::class, [
				'label' => 'Бюджет',
			]);
	}

	public function getBlockPrefix()
	{
		return 'media';
	}
}
