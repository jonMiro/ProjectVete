<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    apellidos: '',
    email: '',
    password: '',
    password_confirmation: '',
    direccion: '',
    telefono: '',
    tipo: 'cliente',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
  <!-- div logo + titulo -->
<div class="flex justify-between items-center mb-6">
    <!-- Logo -->
    <div>
        <img src="/images/logo.webp" alt="Logo" class="w-32 h-auto" />
    </div>

    <!-- Título del formulario -->
    <div class="flex-1 text-center">
        <h1 class="text-3xl font-semibold ml-6">Formulario de Registro</h1>
    </div>
</div>

        <form @submit.prevent="submit" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Nombre -->
            <div>
                <InputLabel for="name" value="Nombre" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Apellidos -->
            <div>
                <InputLabel for="apellidos" value="Apellidos" />
                <TextInput
                    id="apellidos"
                    v-model="form.apellidos"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="family-name"
                />
                <InputError class="mt-2" :message="form.errors.apellidos" />
            </div>

            <!-- Email -->
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Dirección -->
            <div>
                <InputLabel for="direccion" value="Dirección" />
                <TextInput
                    id="direccion"
                    v-model="form.direccion"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.direccion" />
            </div>

            <!-- Teléfono -->
            <div>
                <InputLabel for="telefono" value="Teléfono" />
                <TextInput
                    id="telefono"
                    v-model="form.telefono"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.telefono" />
            </div>


          <!-- Tipo (fijo a "cliente") -->
           <div>
            <InputLabel for="tipo"  />
            <input
            type="hidden"
            id="tipo"
            v-model="form.tipo"
            value="cliente"
                                />
        </div>


            <!-- Contraseña -->
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="sm:col-span-2 mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />
                        <div class="ms-2">
                            Acepto <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terminos de servicio</a> y <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">las Politicas de Privacidad</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end sm:col-span-2 mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Ya estas registrado?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Registrar
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
