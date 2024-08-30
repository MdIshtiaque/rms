const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"home":{"uri":"\/","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"about":{"uri":"about","methods":["GET","HEAD"]},"services":{"uri":"services","methods":["GET","HEAD"]},"contact":{"uri":"contact","methods":["GET","HEAD"]},"dashboard":{"uri":"admin\/dashboard","methods":["GET","HEAD"]},"users":{"uri":"admin\/users","methods":["GET","HEAD"]},"user.update":{"uri":"admin\/user\/{user}\/update","methods":["POST"],"parameters":["user"],"bindings":{"user":"id"}},"user.delete":{"uri":"admin\/user\/{user}\/delete","methods":["DELETE"],"parameters":["user"],"bindings":{"user":"id"}},"chat.send":{"uri":"chat","methods":["POST"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
