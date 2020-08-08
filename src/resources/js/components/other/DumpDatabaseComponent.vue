<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <div class="form-group row">
          <label for="connect-db" class="col-sm-3 col-form-label">connect</label>
          <input
            type="text"
            class="col-sm-9 form-control"
            id="connect-db"
            v-bind:value="connect"
            readonly
          />
        </div>
        <button class="btn btn-primary mb-5" v-on:click="connection">copy</button>
        <div class="form-group row">
          <label for="dump" class="col-sm-3 col-form-label">dump</label>
          <input type="text" class="col-sm-9 form-control" id="dump" v-bind:value="dump" readonly />
        </div>
        <button class="btn btn-primary" v-on:click="dumping">copy</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    var now = new Date();
    return {
      connect: "docker exec -it SAISAN_db bash",
      dump:
        "/usr/bin/mysqldump --user=homestead --password=secret --host=localhost homestead > /var/lib/mysql/" +
        now.getFullYear() +
        "-" +
        (now.getMonth() + 1) +
        "-" +
        now.getDate() +
        ".sql",
    };
  },
  methods: {
    connection: function () {
      var connectCode = document.getElementById("connect-db");
      connectCode.select();
      document.execCommand("Copy");
      alert("entering container command copied!");
    },
    dumping: function () {
      var dumpCode = document.getElementById("dump");
      dumpCode.select();
      document.execCommand("Copy");
      alert("dumping database command copied!");
    },
  },
};
</script>
