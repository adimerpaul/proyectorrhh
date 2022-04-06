<template>
  <q-page class="q-pa-xs">
    <div class="row">
      <div class="col-12">
        <q-form @submit="createpersona">
          <div class="row">
            <div class="col-3">
              <q-input dense outlined label="paterno" v-model="persona.paterno"/>
            </div>
            <div class="col-3">
              <q-input dense outlined label="materno" v-model="persona.materno" />
            </div>
            <div class="col-3">
              <q-input dense outlined label="nombres" v-model="persona.nombres" />
            </div>
            <div class="col-3">
              <q-input dense outlined label="ci" v-model="persona.ci" />
            </div>
            <div class="col-3">
              <q-input dense outlined type="number" label="sueldo" v-model="persona.sueldo" />
            </div>
            <div class="col-3">
              <q-input dense outlined label="cargo" v-model="persona.cargo" />
            </div>
            <div class="col-3 flex flex-center">
              <q-btn type="submit" color="positive" icon="send" label="registrar"/>
            </div>
          </div>
        </q-form>
      </div>
      <div class="col-12">
        <q-table :filter="filter" title="Personas" :columns="columns" :rows="personas">
          <template v-slot:top-right>
            <q-input outlined dense debounce="300" v-model="filter" placeholder="Buscar">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
        </q-table>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  data(){
    return{
      filter:'',
      columns:[
        {name:"paterno",field:"paterno",label:"paterno"},
        {name:"materno",field:"materno",label:"materno"},
        {name:"nombres",field:"nombres",label:"nombres"},
        {name:"cargo",field:"cargo",label:"cargo"},
        {name:"opciones",field:"opciones",label:"opciones"},
      ],
      persona:{},
      personas:[]
    }
  },
  created() {
    this.mispersonas()
  },
  methods:{
    createpersona(){
      this.$api.post('http://localhost:8000/api/persona',this.persona)
      .then(res=>{
        this.mispersonas()
        this.persona={}
        // console.log(res.data)
      })
    },
    mispersonas(){
      this.$api.get('http://localhost:8000/api/persona')
        .then(res=>{
          this.personas=res.data
        })
    }
  }
}
</script>
