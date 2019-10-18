<?php

namespace App\Model\Media\UseCase\Create;

use App\Model\Media\Entity\Format;
use App\Model\Media\Entity\Price;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
				'label' => 'Дата публикации',
				'widget' => 'single_text',
				'html5' => false,
				'attr' => ['class' => 'js-datepicker', 'autocomplete' => 'off'],
			])
			->add('price', ChoiceType::class, [
				'choices' => \array_flip(Price::toArray()),
				'multiple' => false,
				'expanded' => true,
				'label' => 'Стоимость',
			])
			->add('format', ChoiceType::class, [
				'choices' => \array_flip(Format::toArray()),
				'multiple' => false,
				'expanded' => true,
				'label' => 'Формат',
			]);
	}

	public function getBlockPrefix()
	{
		return 'media';
	}
}
