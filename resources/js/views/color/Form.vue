<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.color_edit') }}
          </template>
          <template v-else>
            {{ $t('route.color_create') }}
          </template>
        </div>
        <el-form ref="color" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
        <el-form-item
          data-generator="name"
          :label="$t('table.color.name')"
          prop="name"
          :error="errors.name && errors.name[0]"
          >
            <el-input
              v-model="form.name"
              name="name"
              :placeholder="$t('table.color.name')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'Color' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button
                :loading="loading.button"
                type="primary"
                icon="el-icon-edit"
                @click="() => update('color')"
              >
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('color')"
              >
                {{ $t('button.create') }}
              </el-button>
            </template>
          </el-form-item>
        </el-form>
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
import GlobalForm from '@/plugins/mixins/global-form';
import ColorResource from '@/api/v1/color';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const colorResource = new ColorResource();

export default {
  components: {
    // {{$IMPORT_COMPONENT_NAME_NOT_DELETE_THIS_LINE$}}
  },
  mixins: [GlobalForm],
  data() {
    return {
      form: {
        id: '',
        name: '',
      }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        name: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.color.name') }), trigger: ['change', 'blur'] },
        ],
        // {{$RULES_NOT_DELETE_THIS_LINE$}}
      };
    },
  },
  async created() {
    try {
      this.loading.form = true;
      const { id } = this.$route.params;
      // {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: color },
        } = await colorResource.get(id);
        this.form = color;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(color) {
      this.$refs[color].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.create'), {
          confirmButtonText: this.$t('button.create'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await colorResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Color' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(color) {
      this.$refs[color].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.update'), {
          confirmButtonText: this.$t('button.update'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await colorResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Color' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
