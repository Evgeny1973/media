<?php

namespace App\Model\Media\UseCase\Create;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
			->add('publishingDate', DateTimeType::class, [
				'label' => 'Дата публикации',
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
