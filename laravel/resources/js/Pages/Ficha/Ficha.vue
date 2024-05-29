Ficha.vue:
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

<<<<<<< Updated upstream
const {props}=usePage();
const paciente =props.agendamento.paciente;
const dados_consulta=props.agendamento;

const ficha =props.agendamento.ficha;

const endereco =ref([]);

let chegada=props.agendamento.chegada;
=======
const { props } = usePage();
const paciente = props.agendamento.paciente;
const dados_consulta = props.agendamento;
>>>>>>> Stashed changes

const ficha = props.agendamento.ficha;

const endereco = ref([]);

const fetchAddress = async () => {
    if (paciente.cep.length === 8) {
        try {
            const response = await fetch(`https://viacep.com.br/ws/${paciente.cep}/json/`);
            const data = await response.json();
            if (!data.erro) {
                endereco.value = data;
            } else {
                console.log('CEP não encontrado');
            }
        } catch (error) {
            console.error('Erro ao buscar endereço:', error);
        }
    }
};
onMounted(() => {
    fetchAddress();
});
const Finaliza =  () => {
    chegada=2;
    const scheduleId = props.agendamento.id;
    axios.post(`schedule/update/${scheduleId}`,chegada);

};
const enviarFormulario = async () => {
    try {
        const dadosFormulario = {
            id: ficha.id,
            paciente_id: paciente.id,
            paciente_name: ficha.paciente_name,
            email: paciente.email,
            numero_cel: ficha.numero_cel,
            genero: ficha.genero,
            cep: paciente.cep,
            data_atendimento: dados_consulta.data,
<<<<<<< Updated upstream
            queixa:ficha.queixa,
            atestados:ficha.atestados,
            diagnostico:ficha.diagnostico,
            encaminhamentos:ficha.encaminhamentos,        
=======
            queixa: ficha.queixa,
            atestados: ficha.atestados,
            diagnostico: ficha.diagnostico,
            encaminhamentos: ficha.encaminhamentos
>>>>>>> Stashed changes
        };
        if(chegada===2){

        }
        // Envie os dados do formulário para o backend
        await axios.post('/attFicha', dadosFormulario);
        // Exibir uma mensagem de sucesso para o usuário, redirecionar ou fazer qualquer outra ação necessária
        alert('Ficha atualizada com sucesso!');
    } catch (error) {
        // Lidar com erros, se houver
        console.error('Erro ao atualizar ficha:', error);
        alert('Erro ao atualizar ficha. Verifique o console para mais detalhes.');
    }
};
</script>

<template>
    <div class="container">
<<<<<<< Updated upstream
      <h1>Ficha Técnica de Atendimento</h1>
      <form id="fichaTecnicaForm" @submit.prevent="enviarFormulario">
        <div class="form-group">
          <label for="nome">Nome do Paciente</label>
          <input type="text" id="nome" name="nome" :placeholder="ficha.paciente_name" v-model="ficha.paciente_name">
        </div>
        <div class="form-group">
          <label for="formas de contato">Formas de contato</label>
          <div>
            <label>E-mail</label>
            <input :placeholder="ficha.email" readonly v-model="ficha.email">
          </div>
          <div>
            <label>Telefone</label>
            <input :placeholder="ficha.numero_cel" v-model="ficha.numero_cel">
          </div>
        </div>
        <div class="form-group">
          <label for="genero">Gênero</label>
          <select id="genero" name="genero" v-model="ficha.genero">
            <option :value="ficha.genero">{{ficha.genero}}</option>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="outro">Outro</option>
          </select>
        </div>
        <div class="form-group">
          <label for="endereco">Endereço</label>
          <input id="logradouro" name="logradouro" :placeholder="endereco.logradouro" readonly>
          <label for="cidade">Cidade</label>
          <input id="localidade" name="localidade" :placeholder="endereco.localidade" readonly>
          <label for="estado">Estado</label>
          <input id="uf" name="uf" :placeholder="endereco.uf" readonly>
        </div>
        <div class="form-group">
          <label for="dataAtendimento">Data do Atendimento</label>
          <input id="dataAtendimento" name="dataAtendimento" :placeholder="ficha.data_atendimento" v-model="ficha.data_atendimento" >
        </div>
       
        <div class="form-group"  v-if="props.auth.user.role !== 1">
          <span for="encaminhamentos">Área do Profissional</span>
          <div class="form-group">
          <label for="queixaPrincipal">Queixa Principal</label>
          <textarea id="queixaPrincipal" name="queixaPrincipal" rows="4" :placeholder="ficha.queixa" v-model="ficha.queixa"></textarea>
        </div>
        <div class="form-group">
          <label for="atestados">Atestados</label>
          <textarea id="atestados" name="atestados" rows="4"  :placeholder="ficha.atestados" v-model="ficha.atestados"></textarea>
        </div>
        <div class="form-group">
          <label for="diagnostico">Diagnóstico</label>
          <textarea id="diagnostico" name="diagnostico" rows="4" :placeholder="ficha.diagnostico" v-model="ficha.diagnostico"></textarea>
        </div>
        <div class="form-group">
          <label for="encaminhamentos">Encaminhamentos</label>
          <textarea id="encaminhamentos" name="encaminhamentos" rows="4" v-model="ficha.encaminhamentos" :placeholder="ficha.encaminhamentos"></textarea>
        </div>
=======
        <Link :href="route('dashboard')" class="btn-back">Voltar</Link>
        <h1>Ficha Técnica de Atendimento</h1>
        <form id="fichaTecnicaForm" @submit.prevent="enviarFormulario">
            <div class="form-group">
                <label for="nome">Nome do Paciente</label>
                <input type="text" id="nome" name="nome" :placeholder="ficha.paciente_name" v-model="ficha.paciente_name">
            </div>
            <div class="form-group">
                <label for="formas de contato">Formas de contato</label>
                <div>
                    <label>E-mail</label>
                    <input :placeholder="ficha.email" readonly v-model="ficha.email">
                </div>
                <div>
                    <label>Telefone</label>
                    <input :placeholder="ficha.numero_cel" v-model="ficha.numero_cel">
                </div>
            </div>
            <div class="form-group">
                <label for="genero">Gênero</label>
                <select id="genero" name="genero" v-model="ficha.genero">
                    <option :value="ficha.genero">{{ficha.genero}}</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input id="logradouro" name="logradouro" :placeholder="endereco.logradouro" readonly>
                <label for="cidade">Cidade</label>
                <input id="localidade" name="localidade" :placeholder="endereco.localidade" readonly>
                <label for="estado">Estado</label>
                <input id="uf" name="uf" :placeholder="endereco.uf" readonly>
            </div>
            <div class="form-group">
                <label for="dataAtendimento">Data do Atendimento</label>
                <input id="dataAtendimento" name="dataAtendimento" :placeholder="ficha.data_atendimento" v-model="ficha.data_atendimento" >
            </div>
            <div class="form-group">
                <label for="queixaPrincipal">Queixa Principal</label>
                <textarea id="queixaPrincipal" name="queixaPrincipal" rows="4" :placeholder="ficha.queixa" v-model="ficha.queixa"></textarea>
            </div>
            <div class="form-group" v-if="props.auth.user.role !== 1">
                <label for="atestados">Atestados</label>
                <textarea id="atestados" name="atestados" rows="4" :placeholder="ficha.atestados" v-model="ficha.atestados"></textarea>
            </div>
            <div class="form-group" v-if="props.auth.user.role !== 1">
                <label for="diagnostico">Diagnóstico</label>
                <textarea id="diagnostico" name="diagnostico" rows="4" :placeholder="ficha.diagnostico" v-model="ficha.diagnostico"></textarea>
            </div>
            <div class="form-group" v-if="props.auth.user.role !== 1">
                <label for="encaminhamentos">Encaminhamentos</label>
                <textarea id="encaminhamentos" name="encaminhamentos" rows="4" v-model="ficha.encaminhamentos" :placeholder="ficha.encaminhamentos"></textarea>
             </div>
        <div class="form-group"  v-if="props.auth.user.role !== 1">
          <span for="encaminhamentos">Área do Profissional</span>
          <label>Informações adicionais da sessão</label>
          <textarea id="encaminhamentos" name="encaminhamentos" rows="4"></textarea>
>>>>>>> Stashed changes
        </div>
          <div class="form-actions">
          <button type="submit" class="save">Salvar</button>
          <button type="reset" class="reset">Resetar</button>
          <button type="button" class="reset" @click="Finaliza">Finalizar sessão</button>

        </div>
        </form>
    </div>
</template>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}
.container {
    max-width: 800px;
    margin: 0 auto;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 5px;
    background-color: #f9f9f9;
}
h1, h2 {
    text-align: center;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    display: block;
    font-weight: bold;
}
.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.form-group textarea {
    resize: vertical;
}
.form-actions {
    text-align: center;
}
.form-actions button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.form-actions .save {
    background-color: #28a745;
    color: #fff;
}
.form-actions .reset {
    background-color: #dc3545;
    color: #fff;
}
.btn-back {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}
.btn-back:hover {
    background-color: #0056b3;
}
</style>
