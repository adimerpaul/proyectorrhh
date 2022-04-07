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
<!--              <q-input dense outlined label="cargo" v-model="persona.cargo" />-->
              <q-select outlined dense :options="cargos" v-model="cargo"></q-select>
            </div>
            <div class="col-3">
              <q-input dense outlined type="date" label="sueldo" v-model="persona.fechafin" />
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
              <q-btn size="xs" @click="imprimircre(props.row)" label="credencial" icon="print" color="accent"/>
              <q-btn size="xs" @click="frmupdatepersona(props.row)" label="modificar" icon="edit" color="warning"/>
              <q-btn size="xs" @click="subirimagen(props.row)" label="imagen" icon="photo" color="info"/>
              <q-btn size="xs" @click="deletepersona(props.row.id)" label="eliminar" icon="delete" color="negative"/>

            </q-td>
          </template>
          <template v-slot:body-cell-foto="props">
            <q-td :props="props">
              <q-img width="200" v-if="props.row.foto!=''" :src="url+'../imagenes/'+props.row.foto"/>
<!--              {{ url + '../' + props.row.foto }}-->
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
    <q-dialog v-model="modalphoto">
      <q-card style="width: 400px;max-width: 40vw">
        <q-card-section class="text-h6">Subir imagen</q-card-section>
        <q-card-section class="q-pt-none">
          <q-uploader
            class="full-width"
            label="Subir imagen"
            :factory="uploadFile"
          />
        </q-card-section>
        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn flat label="OK" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
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
<!--                <q-input dense outlined label="cargo" v-model="persona2.cargo" />-->
                <q-select outlined dense :options="cargos" v-model="cargo"></q-select>
              </div>
              <div class="col-6">
                <q-input dense outlined type="date" label="sueldo" v-model="persona2.fechafin" />
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
import {date} from "quasar";
import { jsPDF } from "jspdf";

export default {
  data(){
    return{
      url:process.env.API,
      modalphoto:false,
      medium:false,
      filter:'',
      cargos:[
        {label:'TECNICO'},
        {label:'INGENIERO'},
        {label:'PROFECIONAL'},
        {label:'INFORMATICO'},
      ],
      cargo:{label:'TECNICO'},
      columns:[
        // {name:"paterno",field:"paterno",label:"paterno"},
        // {name:"materno",field:"materno",label:"materno"},
        {name:"nombre",field:"nombre",label:"nombre"},
        {name:"foto",field:"foto",label:"foto"},
        {name:"cargo",field:"cargo",label:"cargo"},
        {name:"opciones",field:"opciones",label:"opciones"},
      ],
      persona:{fechafin:date.formatDate(new Date(),'YYYY-MM-DD')},
      persona2:{},
      personas:[]
    }
  },
  created() {
    this.mispersonas()

  },
  methods:{
    imprimircre(persona){
      const doc = new jsPDF()
      doc.setFontSize(10)
      var img= new Image()
      img.src="plantilla.jpg"
      doc.addImage(img,'jpg',1,1,150,150)
      var imgfoto= new Image()
      imgfoto.src=this.url+'../imagenes/'+persona.foto


        // doc.addImage(imgfoto,'jpg',1,1,50,50)
        // doc.text("Hello world!", 10, 10);
        doc.text(persona.paterno, 67, 87)
        doc.text(persona.materno, 67, 93)
        doc.text(persona.nombres, 67, 99)
        doc.text(persona.fechafin, 67, 104)
        // doc.save("a4.pdf");
        window.open(doc.output('bloburl'), '_blank')


    },
    uploadFile(files){
      this.$q.loading.show()
      const fileData= new FormData()
      fileData.append('imagen',files[0])
      fileData.append('persona_id',this.persona2.id)
      this.$api.post('upload',fileData)
      .then(res=>{
        console.log(res.data)
        this.modalphoto=false
        this.mispersonas()
      })
    },
    frmupdatepersona(persona){
      this.persona2=persona
      this.cargo={label: this.persona2.cargo}
      this.medium=true
    },
    subirimagen(persona){
      this.persona2=persona
      this.modalphoto=true
    },
    createpersona(){
      this.$q.loading.show()
      this.persona.cargo=this.cargo.label
      this.$api.post('persona',this.persona)
      .then(res=>{
        this.mispersonas()
        this.persona={}
        // console.log(res.data)
      })
    },
    updatepersona(){
      this.$q.loading.show()
      this.persona2.cargo=this.cargo.label
      this.$api.put('persona/'+this.persona2.id,this.persona2)
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
        this.$api.delete('persona/'+id)
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
      this.$api.get('persona')
        .then(res=>{
          this.personas=[]
          res.data.forEach(r=>{
            let d=r
            d.nombre=r.paterno+' '+r.materno+' '+r.nombres
            this.personas.push(d)
          })
          this.$q.loading.hide()

        })
    }
  }
}
</script>
