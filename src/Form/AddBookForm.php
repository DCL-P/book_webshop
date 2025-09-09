<?php

namespace App\Form;

use App\Entity\BookLists;
use App\Repository\BookListsRepository;
use App\Entity\Books;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddBookForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('BookLists', ChoiceType::class, [
                'choices' => $options['book_lists'],
                'choice_label' => fn($bookList) => $bookList->getName()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'book_lists' => []
        ]);
    }
}
