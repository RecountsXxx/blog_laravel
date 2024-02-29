<template>
  <div class="col-sm-2 w-100 d-flex flex-column">

    <div class="logo w-full mt-4 d-flex flex-row align-items-center">
      <img src="https://img.icons8.com/color/48/control-panel--v1.png" alt="logo" width="60px" height="60px">
      <label class="ms-3 fs-2 text-white">Artzone</label>
    </div>
    <hr class="text-white"/>
    <div class="logo w-full d-flex flex-row align-items-center">
      <img src="https://img.icons8.com/color/48/circled-user-male-skin-type-3--v1.png" alt="logo" width="60px" height="60px">
      <label class="ms-3 fs-4 text-white">{{ name }}</label>
      <img @click="reloadPage" class="ms-4 c_pointer" width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNUlEQVR4nO3aO05DMRBGYUNBiwQtG0FZGG0aXjvJCmgQC6AIUNDR5rKNE01kikjJlSfRDf+MfHpL88nJfckFuACegV90GoBHm620Bjyh24MHYnrrtogEzOpMg2fRpiIW3rk6ZOLoOyIWfUfEAu5SXLUsYF4yQFx1yIQBC+AFuAz90wKWdaz3Zowo5Ab4qaMZ6iok5CCMKmQH5mMUowxxYdQhezDXJSKkCRMFsgPzuYWJBBnFRIPsxRwDAc6AL/6/5bGQ8/rHiw1J89OSugwTCMLYvSQKhAw3RFqet9QhtD7OK0PwvJOoQsjwYkWWV13gO8vHhzfgNfznoIPqkBNEho/YwNw1lzBk03QLThTeuTpk4ug7kmBHhrpmVvQO1aw8i+xclGr3HogdPDPM384otDKE5+DZGhon/IxufD43AAAAAElFTkSuQmCC">
    </div>
    <hr class="text-white"/>


    <div>
      <div class="w-100 ">
        <button class="btn w-full w-100 btn-secondary d-flex align-items-center" type="button">
          <img height="30" width="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFCklEQVR4nO2aS2xVVRSGzxVaMZFWWqQoYIwTBYkDCM6IRGM6sChgWiXGoYbaBh0oUUwKOiOYRoc6MEYTiUo0qYgmxogBEWOoRikFHzzUmZX4DtbSz6zef8fl7Xncx7mXaviTM+je+6y91tnr8a99G0UX8D8FcBlwB7ATeAsYBc4Af+o5o7E9WnM70BrNBADNwEbgbWCCyjEho+82WdF5MOBiYDPwnVPqLLAP2AasB5YB84AmGTxPY+u15gOdVMC3QH/DDAJuBb50CnwGbDJFE9ZfYk/CXBvQKxkB5n431/sUngEmteHnQBdQyHjPjD6esaYArAWOSLbtMZj76QCXA4ecCz1iLlPmu1Moc20TsEV7GA4C7TUbIOFXAcck+GtghZszX99cqyHAg8CA+3slcMK52pI8TiIYcRhY4OZmAb/JDVanyLCMtjdlfrVkmKyL3HgHMKy9j1Z9MoqJQ86Ilpg1diKG4ao2Kcr4VDK2xcy1OmM+rCpmFNjBnRYkrJkDjADfZAV9SpCfkIw5CWs6nJsNVpNiJxV0KzLWzrbTq9CG0pOfnbFmlWrOZNmpWYKP6ws8HM0QAI+64M92MVXsUCemvhQwvxHKpkHswFzQ0FfO4kA7ujT2kP5+FVgcNQAUU/6AYu89N26k1HA69VREAAPtKLh4+VXjPwFX1kl5c+ke4B3gnKMsB0uSg3mKoSfKyPmGTSXji4GXgS9yq7T/yL4BeBoYYzreLaX65laa25PWT0woU8USwByVbxVZ/IRkPB9Hg+xDAuN6ptU2W7BOAt6vowFGPZ5VFce563PAkP62FLs9Q84BH8elk9a1xVbYGpVfBDyuwhpwTm6zUVT+dY2fBe4pQ+YTWr8jbtJaUMO6nAxoAV4o6RxPS4mrXdX+WHM/AjeVKXuD3hmKmwzN0tIcjDAFv3Jf+RWgs4QULnXUw9LsdRXIv17vHYubDFmj3fUG1+ipiIIAL0rWbmPQMfNrdBlh+CiJy7m0HPRoCgVa7/4QlcL1z1OFxtF3VCRT+VDCR+mImbvX7bU7qQ12H/N7p8cxZ9zUaUdlGLJLR27Pm5WwW+AXyVpYUswGXKv8lHe1BDkFxW7QY1c5hvzLtWoB8IZkvQZcYWwAeEljFvwP1Ch/fpprBca7rJZNJOtaFwMeRnVuy0H+cskbbUT6XSKi+bP8fEdIuznI3pCWfkNBTK2qMwHAk2kFMVDkfdEMB8X+nVg3FWn8S9mrLWZ+VixJq5+yLbZnQqAH0jg36eW9srS3ZLxTyeB3n1LrBYqZ7g/t2Vky158YH27RXTGN1f0u69j4pQ0wZK67JjLcF9NYdWe1unYrblirsW7gpF1ElHtNmpMxTdrzZFDatRqnMnVxR3ekkYpngeJHPhrn+mkv2JWLYUs0QwBslU4jZX9g4BZ3Qbey7lpm63Oju6BbU+nL9vsE6hmmsdhGAViomDDsrEZAs36fQBfJDf/hkuIlRche+6uOWd1YhACzq6BFuWubfhLDLi7a8iB/wRhLhaty0zY9Jk45I/K54dTJBH5jQfdYPVIzRXfe6pq8/TWfRMImg67DGxHRLOQgu6BiNyrZk2Lj9atj9vuE2xBRhr5qOksRwH7FX8BIxSm2xtPp0z1VwLhcYbsan+VyyWY97Rq7U3dbB8S2Aywmes8Lm5CCPeouvVLlYlwXG90zhg5RZKxdammH5H5j7p9qxpT9hrSmK7GfuIDov4+/AVX8tzNEmwMGAAAAAElFTkSuQmCC">
          <router-link to="/dashboard" class="fs-5 text-decoration-none text-white ms-3">Dashboard</router-link>
        </button>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACKklEQVR4nO2av04UURSHrwF5AYL8sbCkp4SGGDuIhWBlrKSWhIC0ECyIxsKSJ5A3QIoFCmPlO1hZGAvCCkQh8JEDv0luNgPe3Z25M+D9ksnevXPm3PPbc3Yyd886l0gkOgKYBhrAIdXzW7FMtSviLfVlrZ1MGH+ARWDYVQwwDCwpJoIyA+zIeNHVDOCNYmuEGFs9GkOuZgBDiq0ZYnyJqymExpeERIKUkZpByoigIlzRGbmLQkZdyQCjMYQ0gdkC48571tuPIcQ4B9aBngIF3AOWgbNYpbUAnGq8DfQXIKJfvpBvW6NcIRpPAj819R0Y60LEmHwY5nMyNI6uhej9Q+Crpm2f8KoDES+AI/n4BjxqN46uhWiuV9+VjA2gL2CNf15HTCHeuZfAsUy+3LSrBAa8zZtlcq6oOIoQMqPbcsYPYDzHblznMg6AZ9f4bDuOjh2oRN7rdmxsArsa/wVWgQc6VjWHbD5pbNe+M1+uCiHAILCn6RNg3hP3wRPnc65zl0EDr3VtJm4wqhBgwisRe53IsX8CfAZ+6dgCHufY5fqibCEtn+Ke/yl2irKbleSJ1ihdSFYiH4H73Yrw/PcAK60lWaYQuzs9L0pAzjpPYz003pnH+Ki4JES4mkJofElIJEgZqRn8jxlpyrbyllsr2l4bByHG1j01llzN4OrnouDW25S3DbWe3UiUKG+OaUQiso1ZWJvaWsDc9vZ0S2YaXnP09v1hIJFIuIwLPaAe/ccUsQsAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Post</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/posts" class="fs-5 text-decoration-none text-black ms-3">Show posts</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAClklEQVR4nO2YTW4TQRCFrSwwcAVWEOSb2DL7WHgW4QSECxBYIC4QyXCDZE8SrsDPKmxAEZK5AbaCI2CB9aFCZWlod/fU9IwXUfpJvbBd/fxed3VN9XQ6GRkZXgBd4AnwAbgkjEuN2ZM5Bt4toAcMgBFQBMZIYyR2q4rX/ZM7wCfq40zmRnhvAQ8ioovAGMrcOiufIr5sohtY+RTxRclE9U5o2jTFYw9vr4H4QkfPYuBjCwbee3gHLRjoWwwsWjCw8PDGDmxhHCOLgVbg4S3aGJ1swIi8A+QUuroptKA5LjZURneuxYNs76q3El1tyFIhc28Emrnhxpu5Ujt9tqF2erjRdnoFWUVJBcnnioMtv73T2LWVj1xo+oYLTT/pQpORkdFZVYxnwBEwjhy2scbsAzer1g64DbwEzoHfWgiWwMRziFdvLip53T/ZBr6WKs1JxMDbUpyIuhfhvQ98c6rY0iN+NSb6+1Q01Vn5snjBRcSAW2LPfTVbVz5F/ApT004Az1nH94iBuSd+38MraZMqHv1suhNLPrt4EzFw7Ik/9PDKzljEHwB/HD6Jf21t5saa8z+AmQrcjRh4pDEzTTWZO/bw/iqJeZUgvrDuQEjorgqdW4x5eJuKL3y8dQz4UuW4hoHG4mlowHdY5zUMpOR80aYBSRtzdTLyHtQRL4vQdgoFq5OBt674f/FtHOJZ4iFuLB7P245QGT3VJ+zcWEZPNHahcx96eEdNxQM/Ux9kwWqj4l0ceXgHKTnP/0/kLxYD0oGaq02gOj0N7MCyYTvxwtrMlR/7Kc3cWtMl32lDlip+am6rpSV2TMTa6VNH/N2KNn2aKH7bJN5ZMbmkHLZ8oRHencBbiUlJvPROnyVtal9oMjKuEf4CNpCSz5jgHqsAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1 ">Categories</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/category" class="fs-5 text-decoration-none text-black ms-3">Show categories</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACB0lEQVR4nO2Xu0okQRSGC28gGq66oG+wGymma6qMsqBj4L6AsmZiZuSqYOYjiKH4DF4QU3Vz8TaGgndFFPzksKWMNdU93dPVM71YHzQMnMt/TvXpqhqlPB6Px+NxCNAOzAP7wJ1+9oA5saksA4wCNwQjtrzKcPEvlOclc03wb2zCVt7kGmhTWUHPfFz+qKwA/K2ggb20i/oJbBXtJJvAUIBvnPF54yapbljxiyHCC44auE6qq0JWoByDRozs+YlGiAp0gxqQ11eODSNGDqm4zCbVDWrgNu78VrCNXgFfkuo6a0DH5WMcZMOudEvQX3051ksj35uQQyps5Ydd635AtqwIiXIh8W1ySAG7elVv9e9Zc2xc6prJFkKSzKmUwKWubFny1Ret4nrkFUgANdL11BSgGegDZoBVfTKfA4/6Odf/yla1zw+JUTUuugEYAdaAB+Jzr2MlR4PrwnLAEjBmsdcDE8AR7jgCxoE6i94vXUsutFE9BpNFhR0CjYZPV8Q7S6VsAp2GZhNwXNTo75LxA3qBAyPZlOHzFTglfU6ADkN72vCRWnvejD0B95BvRpIVqseyof3d4iOXx24x7gQkaTGSXFI9Lgzt1gC/bTE+2yyWb6SqqGj6T4GF/ScN4BtIC/WZ3sBZxARWv5QoRGygIIYBW3GWBFa/FCgA/REasPp5PB6P53PxCgdOAt2KUDGbAAAAAElFTkSuQmCC">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Users</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/user" class="fs-5 text-decoration-none text-black ms-3">Show users</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD0UlEQVR4nO2aW4hNURjH94zruAwjzAwlt8TIuKckSSISSRPNg5K7B5eh5EFqXGZexLwQhcwLiZJcEoo0JSmDmoQxZnK/lxiG/LTyHZbT3mdf1jpntvKvXdPe6/vv///svdb3rW+P4/zHf/wbAMYCW4ErwAPgkxyNwHFgLpDlxBVAEXCBYDgFdHHiBmCq/OoKb4EqYBYwEOgE5ACDgTXAaxn3GagG8p04ACjWTBwG8nzGTwBqge8S8xAoyJxiDwDXRNDBMO8+MAC4IbGnndYEME6EvI7yzqsnAXwQjvHpURlMSLmI2GPAsUs4dttVF07EWREx13ChULhuV104EXUiYrgBRz/heGFXXTgRT0TEIAOODsAPOXLsKgwuokmMFBnyJJbv7vbUhRNwVwSMMeBor2X8tnYVBhdxUgTMN+BQS7DCJ7vqwonYJiLKLaxaN+2qCyei1DQzA1uEY59ddeFErBARzww4aoTjkF114UTcERGLDDgmSgH5Bci2qzC4iJdipK8hz9vWXn6viIAFBhx9hON9q+0cgTIR8QjYECF+jjZHjqVHZTAhnYFbIqQ2QvxRiX0DDEmPyuBiegDf5OgaIi4beC5GRjlxAHBVBC0LETMr6pPMRGKsBzoGGN9OeyVXOnEB0Aa4LcJOKKE+4/fK2Ht+YzMOYITME4VuPmPVPv2dW9XML55kjE6reA+BQYw0JExIHvmdP4ASFyOLtetZKiYuRoZpPTHVgbmYqA74U0TqqJJrvYFzElOcCSOX/fbxmokEVJlSoe06dbwCKlVxqp1Ljxn1iwIt2o1apNWT6zFWNxEVr8LkriAmsrSuoY6vqrr1GH/egpH9tgwMBfrL3wulE6JjeYrYfK16joJGt6cdNmfMAy6J8LoEIbBDu9HeAFxHDIxURDWQC2wCHruQnpHaKVu+fajGdnsPnhnAeuAA8NGFqxlYJ02JQhmrzrnNj33AWmB6UBNLJTAVKmVs18Q3D2BV8hwJ8EuvS7Fd8ISfgRyt5eMH9ZqVarHTJNP/lZUD8BS46CiMbEQaZyofhIH6CjVFcoTaY1xw4fVDoW0j2zHH7AhGylxiNkYyIvWPntyi4L3bhAd6ApOllfTUJa5Z5kShHBukw5KMJll8Znh+ugM2Y45qz8dtZ/mtdALcwEbWXeJzj5GS+U2eeH8/I6orYopJAXeIJqhJ2cH3SEBhMdynPFF7ElM0tPp3evVaJJlRCVeVOPc9JvbOpKTc4PtqZQry/bBe/kell5xb7WJki1zLUxWvFIwDnTgheT8BzHQxUpIqJpZQ22AXIyP8An8CG1lh8sUUbqUAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Admins</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin" class="fs-5 text-decoration-none text-black ms-3">Show admins</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADoAAAA6CAYAAADhu0ooAAAACXBIWXMAAAsTAAALEwEAmpwYAAACiUlEQVR4nO2bv2sUQRTHD0UFL0X8gRqtBME/wEBQNKLWYlC8QiurqK2IFoqWFkLAJgiKiH+AtqKV2CRaKDEqAbFRUAQhhYqG+JGHczB5zF52b7Mzs8t84cGx+2bffG5m3uzO7LZaOQQcBF4Af6hWC8ATYFvLt4AjwCJ+9dY7LDDrGdKG3eoLsq2CS8t+r8B+ZMDOeoEFNqjAnyuKc75Hy74HhqqIGxto9bCEA/3tgJ0BtjQN9BbwyAH7rpJsTDjQm8Bab7AEBDXHBfZh5bAEBl0GduVuKogA1JxfkwH7GthcJ9BzKs4z4JKyq8C8A/ZVaVj8gY5RTk/rAroe+FAC9C8wED2oiTUMfCwBu7EWoCbeAHDaMT5dNl9b0CKSuiTQokotWvHDfuO7LrAH+AocaywosAP4ZM2L15sK+kDFEtjhJoK21fPnlWX86wUKbLd+rwYmgHs5yoUFBXYWuP5Fs9x5WB1fFTUosNf4PQdOynNkD98T1g6AbEWcLVi3oKD3lb9k0Wt29zR+I8BP5SvTymD0oMAm4BduLZrNo6PStYEv6ryU21ewbsFAdxsYmRZ6Sa/Zin/Huo78GTcsG4kKtCtgl6ngN/LpsiovWdfWuH0+uukFWGcSkrRylu46ytUL1LF6cEftmj12ZeWoQYHjwEvLLmT4DQJngFOyXpvhEzXouPKbKBEzgdpKLdqPUtftc4wCc2ahWmyusWOU/zfvXS0k0KVKLcpSpa6bxmhXKRkppayrlKaXGt0wjAK3Letk+E1aPpMZPh11rdFoQEMogfaj1KIN7LptT6+a92P6g4ZcO+W9YN8Qv2ZKQYpkpyvA5yBFJHU71FoJAQeA6YxXwENJ6jIF7M8D8Q/A/pxydjSTjQAAAABJRU5ErkJggg==">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Reports</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/report_post" class="fs-5 text-decoration-none text-black ms-3">Show post reports</router-link></li>
          <hr/>
          <li><router-link to="/report_comment" class="fs-5 text-decoration-none text-black ms-3">Show user reports</router-link></li>
        </ul>
      </div>

      <label class="position-absolute bottom-0 text-white ms-4 mb-2">© Copyright Artzone LLC  2024</label>
    </div>
  </div>
</template>

<script>
import {userStore} from "@/stores/store.js";

export default {


  name:'navComponent',
  data(){
    return{
      name:'Name'
    }
  },
  created() {
    const store = userStore();
    const userData = store.get;
    this.name = userData.name;
  },
  methods:{
    reloadPage(){
      location.reload();
    }
  }
}
</script>

<style>
.c_pointer:hover{
  cursor: pointer;
}
</style>