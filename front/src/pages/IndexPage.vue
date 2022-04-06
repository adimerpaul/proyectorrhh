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
          <template v-slot:body-cell-opciones="props">
            <q-td :props="props">
<!--              {{props.row.id}}-->
              <q-btn size="xs" @click="frmupdatepersona(props.row)" flat icon="edit" color="warning"/>
              <q-btn size="xs" @click="deletepersona(props.row.id)" flat icon="delete" color="negative"/>
            </q-td>
          </template>
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
    <q-dialog
      v-model="medium"
    >
      <q-card style="width: 700px; max-width: 80vw;">
        <q-card-section>
          <div class="text-h6">Medium</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-form @submit="updatepersona">
            <div class="row">
              <div class="col-6">
                <q-input dense outlined label="paterno" v-model="persona2.paterno"/>
              </div>
              <div class="col-6">
                <q-input dense outlined label="materno" v-model="persona2.materno" />
              </div>
              <div class="col-6">
                <q-input dense outlined label="nombres" v-model="persona2.nombres" />
              </div>
              <div class="col-6">
                <q-input dense outlined label="ci" v-model="persona2.ci" />
              </div>
              <div class="col-6">
                <q-input dense outlined type="number" label="sueldo" v-model="persona2.sueldo" />
              </div>
              <div class="col-6">
                <q-input dense outlined label="cargo" v-model="persona2.cargo" />
              </div>
              <div class="col-12 flex flex-center">
                <q-btn class="full-width" type="submit" color="warning" icon="edit" label="modificar"/>
              </div>
            </div>
          </q-form>
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn flat label="OK" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
export default {
  data(){
    return{
      medium:false,
      filter:'',
      columns:[
        {name:"paterno",field:"paterno",label:"paterno"},
        {name:"materno",field:"materno",label:"materno"},
        {name:"nombres",field:"nombres",label:"nombres"},
        {name:"cargo",field:"cargo",label:"cargo"},
        {name:"opciones",field:"opciones",label:"opciones"},
      ],
      persona:{},
      persona2:{},
      personas:[]
    }
  },
  created() {
    this.mispersonas()
  },
  methods:{
    frmupdatepersona(persona){
      this.persona2=persona
      this.medium=true
    },
    createpersona(){
      this.$q.loading.show()
      this.$api.post('http://localhost:8000/api/persona',this.persona)
      .then(res=>{
        this.mispersonas()
        this.persona={}
        // console.log(res.data)
      })
    },
    updatepersona(){
      this.$q.loading.show()
      this.$api.put('http://localhost:8000/api/persona/'+this.persona2.id,this.persona2)
        .then(res=>{
          // this.$q.loading.hide()
          this.mispersonas()
          this.medium=false
          // this.persona={}
          // console.log(res.data)
        })
    },
    deletepersona(id){
      if (confirm("Seguro de elimnar?")){
        this.$q.loading.show()
        this.$api.delete('http://localhost:8000/api/persona/'+id)
          .then(res=>{
            // this.$q.loading.hide()
            this.mispersonas()
            // this.persona={}
            // console.log(res.data)
          })
      }

    },
    mispersonas(){
      this.$q.loading.show()
      this.$api.get('http://localhost:8000/api/persona')
        .then(res=>{
          this.$q.loading.hide()
          this.personas=res.data
        })
    }
  }
}
</script>
