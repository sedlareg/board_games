<?php

namespace App\Controller\Admin;

use App\Entity\Boardgame;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;

class BoardgameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Boardgame::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Boardgame')
            ->setEntityLabelInPlural('Boardgames')
            ->setSearchFields(['title', 'author', 'year', 'isSdj'])
            ->setDefaultSort(['year' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(NumericFilter::new('year'))
            ->add(BooleanFilter::new('isSdj'));
    }

    public function configureFields(string $pageName): iterable
    {
        /*return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];*/
        yield TextField::new('title');
        yield TextField::new('author');
        yield IntegerField::new('year');
        yield BooleanField::new('is_sdj');
        //yield TextField::new('slug');
    }
}
