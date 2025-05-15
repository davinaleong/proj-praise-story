GET|HEAD / .......................................................................... index › IndexController@index
GET|HEAD confirm-password .................................... password.confirm › App\Livewire\Auth\ConfirmPassword
GET|HEAD dashboard ...................................................................................... dashboard
GET|HEAD flux/editor.css ..................................... Flux\AssetManager@editorCss › AssetManager@editorCss
GET|HEAD flux/editor.js ........................................ Flux\AssetManager@editorJs › AssetManager@editorJs
GET|HEAD flux/editor.min.js .............................. Flux\AssetManager@editorMinJs › AssetManager@editorMinJs
GET|HEAD flux/flux.js .............................................. Flux\AssetManager@fluxJs › AssetManager@fluxJs
GET|HEAD flux/flux.min.js .................................... Flux\AssetManager@fluxMinJs › AssetManager@fluxMinJs
GET|HEAD forgot-password ...................................... password.request › App\Livewire\Auth\ForgotPassword
GET|HEAD livewire/livewire.js ......................... Livewire\Mechanisms › FrontendAssets@returnJavaScriptAsFile
GET|HEAD livewire/livewire.min.js.map ................................... Livewire\Mechanisms › FrontendAssets@maps
GET|HEAD livewire/preview-file/{filename} livewire.preview-file › Livewire\Features › FilePreviewController@handle
POST livewire/update ...................... livewire.update › Livewire\Mechanisms › HandleRequests@handleUpdate
POST livewire/upload-file .............. livewire.upload-file › Livewire\Features › FileUploadController@handle
GET|HEAD login .................................................................... login › App\Livewire\Auth\Login
POST logout .............................................................. logout › App\Livewire\Actions\Logout
GET|HEAD me/my-published-testimonies ............................ me.published.index › Me\TestimonyController@index
GET|HEAD me/my-published-testimonies/{uuid} ....................... me.published.show › Me\TestimonyController@show
GET|HEAD me/testimonies .......................................... me.testimonies.index › TestimonyController@index
POST me/testimonies .......................................... me.testimonies.store › TestimonyController@store
GET|HEAD me/testimonies/create ................................. me.testimonies.create › TestimonyController@create
GET|HEAD me/testimonies/{uuid} ..................................... me.testimonies.show › TestimonyController@show
PUT me/testimonies/{uuid} ................................. me.testimonies.update › TestimonyController@update
DELETE me/testimonies/{uuid} ............................... me.testimonies.destroy › TestimonyController@destroy
GET|HEAD me/testimonies/{uuid}/edit ................................ me.testimonies.edit › TestimonyController@edit
GET|HEAD register ........................................................... register › App\Livewire\Auth\Register
GET|HEAD reset-password/{token} .................................. password.reset › App\Livewire\Auth\ResetPassword
ANY settings ......................................................... Illuminate\Routing › RedirectController
GET|HEAD settings/appearance ............................... settings.appearance › App\Livewire\Settings\Appearance
GET|HEAD settings/password ..................................... settings.password › App\Livewire\Settings\Password
GET|HEAD settings/profile ........................................ settings.profile › App\Livewire\Settings\Profile
GET|HEAD storage/{path} ............................................................................. storage.local
GET|HEAD testimonies/private .................................... private.index › Private\TestimonyController@index
GET|HEAD testimonies/private/{uuid} ............................... private.show › Private\TestimonyController@show
GET|HEAD up .......................................................................................................
GET|HEAD verify-email ......................................... verification.notice › App\Livewire\Auth\VerifyEmail
GET|HEAD verify-email/{id}/{hash} ................................ verification.verify › Auth\VerifyEmailController
GET|HEAD {uuid} ........................................................... testimony.public › IndexController@show
