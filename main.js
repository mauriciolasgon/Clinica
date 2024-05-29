// main.js

// Modules to control application life and create native browser window
const { app, BrowserWindow } = require('electron')
const { exec } = require('child_process');
const path = require('path')
const port = 8000, host = '127.0.0.1';

let mainWindow;

const createWindow = () => {
  // Create the browser window.
  mainWindow = new BrowserWindow({
    width: 800,
    height: 600,
    webPreferences: {
      preload: path.join(__dirname, 'preload.js')
    }
  });

  // Mostrar a tela de carregamento
  mainWindow.loadFile('loading.html');
}

// Iniciar os containers Docker
const startDockerContainers = () => {
  exec('docker-compose up -d', (error, stdout, stderr) => {
    if (error) {
      console.error(`Erro ao iniciar os containers Docker: ${error}`);
      return;
    }
    console.log(`stdout: ${stdout}`);
    console.error(`stderr: ${stderr}`);

    // Aguardar 30 segundos
    setTimeout(() => {
      // Carregar a aplicação principal
      if (mainWindow) {
        mainWindow.loadURL('http://' + host + ':' + port + '/login');
      }
    }, 30000); // 30 segundos
  });
}

// This method will be called when Electron has finished
// initialization and is ready to create browser windows.
// Algumas APIs podem ser usadas somente depois que este evento ocorre.
app.whenReady().then(() => {
  createWindow();
  startDockerContainers();

  app.on('activate', () => {
    // On macOS it's common to re-create a window in the app when the
    // dock icon is clicked and there are no other windows open.
    if (BrowserWindow.getAllWindows().length === 0) createWindow();
  });
});

// Quit when all windows are closed, except on macOS. There, it's common
// for applications and their menu bar to stay active until the user quits
// explicitly with Cmd + Q.
app.on('window-all-closed', () => {
  if (process.platform !== 'darwin') {
    exec('docker-compose down', (error, stdout, stderr) => {
      if (error) {
        console.error(`Erro ao parar os containers Docker: ${error}`);
      }
      console.log(`stdout: ${stdout}`);
      console.error(`stderr: ${stderr}`);
      app.quit();
    });
  }
});

// In this file you can include the rest of your app's specific main process
// code. Você também pode colocar eles em arquivos separados e requeridos-as aqui.
