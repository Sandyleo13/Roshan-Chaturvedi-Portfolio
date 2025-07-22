import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import ContactForm from '@/components/ContactForm';
import { 
  ArrowRight, 
  BookOpen, 
  Users, 
  TrendingUp, 
  Lightbulb,
  ExternalLink,
  Clock,
  Target,
  Heart,
  Star
} from 'lucide-react';
import heroImage from '@/assets/hero-image.jpg';

const Home = () => {
  const [featuredBlog, setFeaturedBlog] = useState<any>(null);
  const [featuredArticle, setFeaturedArticle] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [showContact, setShowContact] = useState(false);

  const stats = [
    { label: "Years in Education", value: "10+", icon: BookOpen },
    { label: "Students Impacted", value: "50K+", icon: Users },
    { label: "Growth Rate", value: "300%", icon: TrendingUp },
    { label: "Innovation Projects", value: "25+", icon: Lightbulb }
  ];

  const achievements = [
    "Founded Just Academy - transforming online education",
    "Built scalable learning platforms serving thousands",
    "Pioneer in AI-powered personalized learning",
    "Recognized thought leader in EdTech innovation"
  ];

  useEffect(() => {
    const fetchData = async () => {
      try {
        const [blogRes, articleRes] = await Promise.all([
          fetch("http://localhost:8000/api/blogs/latest"),
          fetch("http://localhost:8000/api/articles/latest")
        ]);
        if (!blogRes.ok) throw new Error('Failed to fetch blog');
        if (!articleRes.ok) throw new Error('Failed to fetch article');
        setFeaturedBlog(await blogRes.json());
        setFeaturedArticle(await articleRes.json());
      } catch (e: any) {
        setError(e.message || "Failed to load latest insights.");
      } finally {
        setLoading(false);
      }
    };
    fetchData();
  }, []);

  return (
    <div className="min-h-screen pt-16">
      {/* Hero Section */}
      <section className="relative py-20 lg:py-32 overflow-hidden">
        <div className="absolute inset-0 bg-gradient-hero opacity-10"></div>
        <div className="container mx-auto px-4 relative z-10">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div className="fade-in">
              <div className="mb-6">
                <Badge variant="secondary" className="mb-4 bg-secondary/10 text-secondary border-secondary/20">
                  Entrepreneur & Educator
                </Badge>
                <h1 className="font-heading text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                  Transforming Education Through 
                  <span className="gradient-text"> Innovation</span>
                </h1>
                <p className="text-lg md:text-xl text-muted-foreground leading-relaxed max-w-xl">
                  I'm Roshan Chaturvedi, founder of Just Academy. I help entrepreneurs, educators, 
                  and innovators build the future of learning through technology and strategic insights.
                </p>
              </div>
              
              <div className="flex flex-col sm:flex-row gap-4 mb-8">
                <Button size="lg" asChild className="bg-gradient-primary hover-lift group">
                  <Link to="/work">
                    Explore My Work
                    <ArrowRight className="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" />
                  </Link>
                </Button>
                <Button variant="outline" size="lg" asChild className="hover-lift">
                  <a 
                    href="https://justacademy.co" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    className="flex items-center gap-2"
                  >
                    Visit Just Academy
                    <ExternalLink className="w-4 h-4" />
                  </a>
                </Button>
              </div>

              {/* Quick Stats */}
              <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                {stats.map((stat, index) => (
                  <div key={stat.label} className="text-center slide-up" style={{ animationDelay: `${index * 0.1}s` }}>
                    <div className="flex justify-center mb-2">
                      <stat.icon className="w-5 h-5 text-primary" />
                    </div>
                    <div className="font-bold text-lg">{stat.value}</div>
                    <div className="text-xs text-muted-foreground">{stat.label}</div>
                  </div>
                ))}
              </div>
            </div>

            <div className="relative scale-in">
              <div className="relative w-full max-w-lg mx-auto">
                <img 
                  src={heroImage} 
                  alt="Roshan Chaturvedi - Entrepreneur and Educator"
                  className="w-full h-auto rounded-2xl shadow-elegant hover-glow"
                />
                <div className="absolute -bottom-6 -right-6 bg-white p-4 rounded-xl shadow-card border">
                  <div className="flex items-center gap-2">
                    <div className="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    <span className="text-sm font-medium">Building the future</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* About Section */}
      <section className="py-20 bg-gradient-subtle">
        <div className="container mx-auto px-4">
          <div className="max-w-4xl mx-auto">
            <div className="text-center mb-16">
              <h2 className="font-heading text-3xl md:text-4xl font-bold mb-6">
                Bridging Education & Technology
              </h2>
              <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
                My journey from educator to entrepreneur has been driven by a simple belief: 
                technology should make quality education accessible to everyone, everywhere.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
              <div>
                <h3 className="font-heading text-2xl font-bold mb-6">My Mission</h3>
                <p className="text-muted-foreground mb-6 leading-relaxed">
                  As the founder of Just Academy, I've dedicated my career to revolutionizing online education. 
                  Through innovative technology and human-centered design, we're creating learning experiences 
                  that truly transform lives.
                </p>
                
                <div className="space-y-3">
                  {achievements.map((achievement, index) => (
                    <div key={index} className="flex items-start gap-3">
                      <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                      <span className="text-sm text-muted-foreground">{achievement}</span>
                    </div>
                  ))}
                </div>
              </div>

              <div className="space-y-6">
                <Card className="border-0 shadow-card hover-lift">
                  <CardContent className="p-6">
                    <div className="flex items-center gap-3 mb-3">
                      <Target className="w-5 h-5 text-primary" />
                      <h4 className="font-semibold">Vision</h4>
                    </div>
                    <p className="text-sm text-muted-foreground">
                      A world where quality education is accessible to everyone, 
                      regardless of location, background, or economic status.
                    </p>
                  </CardContent>
                </Card>

                <Card className="border-0 shadow-card hover-lift">
                  <CardContent className="p-6">
                    <div className="flex items-center gap-3 mb-3">
                      <Heart className="w-5 h-5 text-red-500" />
                      <h4 className="font-semibold">Values</h4>
                    </div>
                    <p className="text-sm text-muted-foreground">
                      Innovation, accessibility, impact, and putting learners at the 
                      center of everything we build.
                    </p>
                  </CardContent>
                </Card>

                <Card className="border-0 shadow-card hover-lift">
                  <CardContent className="p-6">
                    <div className="flex items-center gap-3 mb-3">
                      <Star className="w-5 h-5 text-secondary" />
                      <h4 className="font-semibold">Impact</h4>
                    </div>
                    <p className="text-sm text-muted-foreground">
                      Empowering over 50,000 learners worldwide with skills and 
                      knowledge for the digital economy.
                    </p>
                  </CardContent>
                </Card>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Featured Content */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <h2 className="font-heading text-3xl md:text-4xl font-bold mb-6">
              Latest Insights
            </h2>
            <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
              Explore my thoughts on entrepreneurship, education technology, and the future of learning.
            </p>
          </div>

          {loading && (
            <div className="text-center mb-8">Loading latest insights...</div>
          )}
          {error && (
            <div className="text-center mb-8 text-red-500">{error}</div>
          )}

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            {/* Featured Blog Post */}
            {featuredBlog && (
              <Card className="overflow-hidden hover-lift cursor-pointer group border-0 shadow-card">
                <Link to={`/blog/${featuredBlog.slug}`}>
                  <div className="h-48 bg-gradient-primary relative">
                    <div className="absolute top-4 left-4">
                      <Badge variant="secondary" className="bg-white/20 text-white border-white/30">
                        Latest Blog Post
                      </Badge>
                    </div>
                  </div>
                  <CardContent className="p-6">
                    <div className="flex items-center gap-4 mb-3">
                      <Badge variant="outline">{featuredBlog.category}</Badge>
                      <span className="text-sm text-muted-foreground flex items-center gap-1">
                        <Clock className="w-3 h-3" />
                        {featuredBlog.readTime}
                      </span>
                    </div>
                    <h3 className="font-heading text-xl font-semibold mb-3 group-hover:text-primary transition-colors">
                      {featuredBlog.title}
                    </h3>
                    <p className="text-muted-foreground text-sm mb-4">
                      {featuredBlog.excerpt}
                    </p>
                    <div className="flex items-center justify-between">
                      <span className="text-primary font-medium text-sm">Read More</span>
                      <ArrowRight className="w-4 h-4 text-primary group-hover:translate-x-1 transition-transform" />
                    </div>
                  </CardContent>
                </Link>
              </Card>
            )}

            {/* Featured Article */}
            {featuredArticle && (
              <Card className="overflow-hidden hover-lift cursor-pointer group border-0 shadow-card">
                <Link to={`/articles/${featuredArticle.slug}`}>
                  <div className="h-48 bg-gradient-secondary relative">
                    <div className="absolute top-4 left-4">
                      <Badge variant="secondary" className="bg-white/20 text-white border-white/30">
                        Featured Article
                      </Badge>
                    </div>
                    <div className="absolute top-4 right-4">
                      {featuredArticle.difficulty && (
                        <Badge className="bg-orange-100 text-orange-800 border-orange-200">
                          {featuredArticle.difficulty}
                        </Badge>
                      )}
                    </div>
                  </div>
                  <CardContent className="p-6">
                    <div className="flex items-center gap-4 mb-3">
                      <Badge variant="outline">{featuredArticle.category}</Badge>
                      <span className="text-sm text-muted-foreground flex items-center gap-1">
                        <Clock className="w-3 h-3" />
                        {featuredArticle.readTime}
                      </span>
                    </div>
                    <h3 className="font-heading text-xl font-semibold mb-3 group-hover:text-primary transition-colors">
                      {featuredArticle.title}
                    </h3>
                    <p className="text-muted-foreground text-sm mb-4">
                      {featuredArticle.excerpt}
                    </p>
                    <div className="flex items-center justify-between">
                      <span className="text-primary font-medium text-sm">Read Article</span>
                      <ArrowRight className="w-4 h-4 text-primary group-hover:translate-x-1 transition-transform" />
                    </div>
                  </CardContent>
                </Link>
              </Card>
            )}
          </div>

          {/* CTA to view all content */}
          <div className="text-center mt-12">
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Button variant="outline" asChild>
                <Link to="/blog">View All Blog Posts</Link>
              </Button>
              <Button variant="outline" asChild>
                <Link to="/articles">View All Articles</Link>
              </Button>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 bg-gradient-hero text-white">
        <div className="flex flex-col sm:flex-row gap-4 justify-center">
          <Button
            size="lg"
            variant="secondary"
            className="hover-lift"
            onClick={() => setShowContact(true)}
          >
            Get in Touch
          </Button>
          <Button
            size="lg"
            variant="outline"
            className="border-white/30 text-white hover:bg-white/10 hover-lift"
            asChild
          >
            <a
              href="https://justacademy.co"
              target="_blank"
              rel="noopener noreferrer"
              className="flex items-center gap-2"
            >
              Explore Just Academy
              <ExternalLink className="w-4 h-4" />
            </a>
          </Button>
        </div>
      </section>

      {/* Contact Form Modal */}
      {showContact && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
          <div className="bg-white rounded-lg shadow-lg p-6 relative w-full max-w-lg">
            <ContactForm onClose={() => setShowContact(false)} />
          </div>
        </div>
      )}

    </div>
  );
};

export default Home;
