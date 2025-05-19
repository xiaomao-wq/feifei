import tkinter as tk
import webbrowser

class VIPVideoApp:
    def __init__(self, root):
        self.root = root
        self.root.title('VIP追剧神器')
        self.root.geometry('600x250')
        self.root.resizable(False, False)  # 禁止窗口大小调整
        self.create_widgets()

    def create_widgets(self):
        # 提示标签
        label_movie_link = tk.Label(self.root, text='输入视频网址：')
        label_movie_link.place(x=20, y=30, width=100, height=30)

        # 输入框
        self.entry_movie_link = tk.Entry(self.root)
        self.entry_movie_link.place(x=125, y=30, width=360, height=30)

        # 清空按钮
        button_movie_link = tk.Button(self.root, text='清空', command=self.empty)
        button_movie_link.place(x=500, y=30, width=50, height=30)

        # 按钮控件
        buttons_info = [
            ("爱奇艺", 25, 80, self.open_iqy),
            ("芒果", 125, 80, self.open_mg),
            ("哔哩哔哩", 225, 80, self.open_bili),
            ("A站", 325, 80, self.open_a),
            ("腾讯视频", 25, 130, self.open_tx),
            ("优酷视频", 125, 130, self.open_yq),
        ]

        for text, x, y, command in buttons_info:
            button = tk.Button(self.root, text=text, command=command)
            button.place(x=x, y=y, width=80, height=40)

        # 播放VIP视频按钮
        play_button = tk.Button(self.root, text='播放VIP视频', command=self.play_video)
        play_button.place(x=25, y=180, width=280, height=40)

        # 提示标签
        lab_remind = tk.Label(self.root, text='提示：本案例仅供学习使用，不可作为他用。', fg='red', font=('Arial', 15, 'bold'))
        lab_remind.place(x=50, y=290, width=500, height=30)

    def open_website(self, url):
        webbrowser.open(url)

    def open_iqy(self):
        self.open_website('https://www.iqiyi.com')

    def open_mg(self):
        self.open_website('https://www.mgtv.com/')

    def open_bili(self):
        self.open_website('https://www.bilibili.com/')

    def open_a(self):
        self.open_website('https://www.acfun.cn/')

    def open_tx(self):
        self.open_website('https://v.qq.com')

    def open_yq(self):
        self.open_website('https://www.youku.com/')

    def play_video(self):
        video_url = self.entry_movie_link.get()
        webbrowser.open('https://jx.xmflv.cc/?url=' + video_url)

    def empty(self):
        self.entry_movie_link.delete(0, 'end')

if __name__ == '__main__':
    root = tk.Tk()
    app = VIPVideoApp(root)
    root.mainloop()

