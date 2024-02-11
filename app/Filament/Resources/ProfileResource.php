<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Http\Request;
use Auth;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fullname')->required()->maxLength(255)->columnSpanFull(),

                TextInput::make('nickname')->required()->maxLength(255)->columnSpanFull(),

                Select::make('user_id')
                    ->relationship(name: 'user', titleAttribute: 'email')
                    ->searchable()
                    ->required()
                    ->columnSpanFull()
                    ->label('Account Email'),

                FileUpload::make('avatar')
                    ->disk('public')
                    ->directory('avatar')
                    ->visibility('private')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('custom-prefix-'),
                    )
                    ->avatar()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fullname')
                 ->label('Name')
                 ->searchable()
                 ->description(fn (Profile $record): string => 'Nama Panggilan : '.$record->nickname),
                TextColumn::make('user.email')->label('Email')->searchable(),
                ImageColumn::make('avatar')->circular()->size(100)->label("Photo")
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ])
                ->button()
                ->label('Actions')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        $profil = Profile::where('user_id', Auth::user()->id)->first();
        return $infolist
            ->schema([
                Section::make('General Info')
                    ->headerActions([
                        Action::make('edit_password')
                            ->label('Change Email Login and Password')
                            ->form([
                                TextInput::make('email')->email()->required()->default(Auth::user()->email),
                                TextInput::make('password')->password()->confirmed()->revealable()->helperText('Kosongkan Password jika tidak ingin mengganti'),
                                TextInput::make('password_confirmation')->password()->revealable()->helperText('Kosongkan Password jika tidak ingin mengganti')
                            ])
                            ->action(function (Request $request) {
                                if(isset($request->input('components.0.updates')['mountedInfolistActionsData.0.email'])) {
                                    $email_change = $request->input('components.0.updates')['mountedInfolistActionsData.0.email'];
                                    if(isset($request->input('components.0.updates')['mountedInfolistActionsData.0.password_confirmation'])) {
                                        $new_password = Hash::make($request->input('components.0.updates')['mountedInfolistActionsData.0.password_confirmation']);

                                        $updt = User::where('id', Auth::user()->id)->update([
                                            'email' => $email_change,
                                            'password' => $new_password
                                        ]);
                                        if($updt) {
                                            ProfileResource::notifSuccess('Successfully Update Password and Email', 'Change Pasword and Email Successfuly Updated');
                                        }
                                    }
                                    else {
                                        $updt = User::where('id', Auth::user()->id)->update([
                                            'email' => $email_change
                                        ]);
                                        if($updt) {
                                            ProfileResource::notifSuccess('Successfully Update Email', 'Change Email Successfuly Updated');
                                        }
                                    }
                                }
                                else {
                                    $new_password = Hash::make($request->input('components.0.updates')['mountedInfolistActionsData.0.password_confirmation']);

                                    $updt = User::where('id', Auth::user()->id)->update([
                                        'password' => $new_password
                                    ]);
                                    if($updt) {
                                        ProfileResource::notifSuccess('Successfully Update Password', 'Change Password Successfuly Updated');
                                    }
                                }
                            })->modalWidth('md')
                    ])
                    ->description('Informasi Umum')
                    ->schema([
                        Infolists\Components\TextEntry::make('fullname')->columnSpanFull(),
                        Infolists\Components\TextEntry::make('nickname')->columnSpanFull(),
                        Infolists\Components\TextEntry::make('user.email')->label('Email'),
                        Infolists\Components\TextEntry::make('updated_at')->label('Last Update')->dateTime('d-M-Y H:i:s','Asia/Jakarta'),

                ])->collapsible(),

                Section::make('Photo')
                ->description('Foto diri')
                ->schema([
                    Infolists\Components\ImageEntry::make('avatar')->circular(),
                ])->collapsible()->collapsed(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function notifSuccess($title, $body) {
       return Notification::make()
        ->title($title)
        ->body($body)
        ->success()
        ->send();

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
            'view' => Pages\ViewProfile::route('/{record}'),
        ];
    }
}
