<script setup>
import { reactive, ref } from 'vue';
import { $post } from '../../composables/useApi.ts';

    const form = reactive({
        email: '',
        password: '',
    });

    const submitting = ref(false);

    const signIn = () => {
        submitting.value = true;
        $post('login', form)
            .then((response) => {
                console.log(response);
            })
            .finally(() => {
                submitting.value = false;
            })
            .catch((error) => {
                console.log(error);
            });
    };
    
</script>

<template>
    <div class="flex-center h-full w-full">
        {{ form }}
        <v-form>
        <v-sheet width="600" class="p-4 space-y-7" rounded="lg" >
            <h1 class="text-center">Sign Up</h1>
            <v-divider></v-divider>
            
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        v-model="form.email"
                        label="Email"
                        outlined
                        dense
                        required
                        :disabled="submitting"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        v-model="form.password"
                        label="Password"
                        outlined
                        type="password"
                        dense
                        required
                        :disabled="submitting"
                    ></v-text-field>
                </v-col>
            </v-row>
            
            <v-row>
                <v-col cols="12">
                    <v-btn
                        color="primary"
                        block
                        @click="signIn"
                    >
                        Sign In
                    </v-btn>
                </v-col>
            </v-row>
        </v-sheet>
    </v-form>
    </div>
</template>

<style scoped></style>