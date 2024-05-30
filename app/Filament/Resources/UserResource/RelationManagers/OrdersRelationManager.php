<?php
namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';
    protected static ?string $recordTitleAttribute = 'id';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('total_amount')
                ->required()
                ->numeric(),
            Forms\Components\Select::make('payment_status')
                ->required()
                ->options([
                    'paid' => 'Paid',
                    'unpaid' => 'Unpaid',
                ]),
            Forms\Components\Select::make('shipping_status')
                ->required()
                ->options([
                    'pending' => 'Pending',
                    'shipping' => 'Shipping',
                    'delivered' => 'Delivered',
                ]),
            Forms\Components\Textarea::make('shipping_address')
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('total_amount')->sortable(),
            Tables\Columns\TextColumn::make('payment_status')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('shipping_status')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
        ])->filters([
            // Add any table filters as needed
        ])->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }
}
